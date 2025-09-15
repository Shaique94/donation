<?php

namespace App\Livewire\Admin;

use App\Models\Expense;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layout.admin')]

class Expenses extends Component
{
    use WithPagination;
    
    public $showModal = false;
    public $expenseId = null;
    public $description;
    public $amount;
    public $date;
    public $category;
    public $receipt_image;
    public $approved_by;
    
    public $searchTerm = '';
    public $filter = '';
    
    protected $rules = [
        'description' => 'required|string|max:255',
        'amount' => 'required|numeric|min:1',
        'date' => 'required|date',
        'category' => 'required|string',
        'approved_by' => 'nullable|string',
    ];
    
    public function render()
    {
        $expenses = Expense::when($this->searchTerm, function ($query) {
                $query->where('description', 'like', '%' . $this->searchTerm . '%')
                      ->orWhere('category', 'like', '%' . $this->searchTerm . '%');
            })
            ->when($this->filter, function ($query) {
                $query->where('category', $this->filter);
            })
            ->orderBy('date', 'desc')
            ->paginate(10);
            
        $totalExpenses = Expense::sum('amount');
        $expensesByCategory = DB::table('expenses')
            ->select('category', DB::raw('SUM(amount) as total'))
            ->groupBy('category')
            ->get();
            
        $categories = DB::table('expenses')
            ->select('category')
            ->distinct()
            ->pluck('category');
            
        return view('livewire.admin.expenses', [
            'expenses' => $expenses,
            'totalExpenses' => $totalExpenses,
            'expensesByCategory' => $expensesByCategory,
            'categories' => $categories
        ]);
    }
    
    public function createExpense()
    {
        $this->resetValidation();
        $this->resetExcept(['searchTerm', 'filter']);
        $this->showModal = true;
    }
    
    public function saveExpense()
    {
        $this->validate();
        
        if ($this->expenseId) {
            $expense = Expense::find($this->expenseId);
            $expense->update([
                'description' => $this->description,
                'amount' => $this->amount,
                'date' => $this->date,
                'category' => $this->category,
                'approved_by' => $this->approved_by,
            ]);
            
            session()->flash('message', 'Expense updated successfully!');
        } else {
            Expense::create([
                'description' => $this->description,
                'amount' => $this->amount,
                'date' => $this->date,
                'category' => $this->category,
                'approved_by' => $this->approved_by,
                'created_by' => auth()->id(),
            ]);
            
            session()->flash('message', 'Expense created successfully!');
        }
        
        $this->showModal = false;
        $this->resetExcept(['searchTerm', 'filter']);
    }
    
    public function editExpense($id)
    {
        $this->expenseId = $id;
        $expense = Expense::find($id);
        
        $this->description = $expense->description;
        $this->amount = $expense->amount;
        $this->date = $expense->date;
        $this->category = $expense->category;
        $this->approved_by = $expense->approved_by;
        
        $this->showModal = true;
    }
    
    public function deleteExpense($id)
    {
        Expense::destroy($id);
        session()->flash('message', 'Expense deleted successfully!');
    }
    
    public function closeModal()
    {
        $this->showModal = false;
        $this->resetValidation();
    }
}