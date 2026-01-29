<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BorrowingController extends Controller{
    public function store(Request $request, Book $book)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        
        $user = User::findOrFail($request->user_id);

        if ($user->debit > 0) {
            return redirect()
                ->route('books.show', $book)
                ->with('error', 'Usuário possui débito pendente.');
        }

        $hasOpenBorrow = Borrowing::where('book_id', $book->id)
            ->whereNull('returned_at')
            ->exists();

        if ($hasOpenBorrow) {
            return redirect()
                ->route('books.show', $book)
                ->with('error', 'Este livro ja esta emprestado e ainda nao foi devolvido');
        }

        $openUserBorrows = Borrowing::where('user_id', $request->user_id)
            ->whereNull('returned_at')
            ->count(); 

        if ($openUserBorrows >= 5) {
            return redirect()
                ->route('books.show', $book)
                ->with('error', 'Este usuario ja possui 5 emprestimos em aberto');
        }

        Borrowing::create([
            'user_id' => $request->user_id,
            'book_id' => $book->id,
            'borrowed_at' => now(),
        ]);

        return redirect()
            ->route('books.show', $book)
            ->with('success', 'Empréstimo registrado com sucesso.');
    }

    
    public function returnBook(Borrowing $borrowing)
    {
        $borrowedAt = Carbon::parse($borrowing->borrowed_at);
        $returnedAt = now();

        $days = $borrowedAt->diffInDays($returnedAt);
        $lateDays = $days - 15;

        
        if ($lateDays > 0) {
            $fine = $lateDays * 0.50;

            $user = User::find($borrowing->user_id);
            $user->debit += $fine;
            $user->save();
        }

        $borrowing->update([
            'returned_at' => $returnedAt,
        ]);

        return redirect()
            ->route('books.show', $borrowing->book_id)
            ->with('success', 'Devolução registrada com sucesso.');
    }

    public function userBorrowings(User $user)
    {
        $borrowings = Borrowing::where('user_id', $user->id)->get();

        return view('users.borrowings', compact('user', 'borrowings'));
    }
}
