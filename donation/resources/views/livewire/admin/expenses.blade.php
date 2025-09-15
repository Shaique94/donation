<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Expense Management</h1>
        <button wire:click="createExpense"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            + Add Expense
        </button>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded" role="alert">
            <p>{{ session('message') }}</p>
        </div>
    @endif

    <!-- Expense Summary -->
    <div class="bg-white rounded-2xl shadow-md p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Expense Summary</h2>
        <div class="grid grid-cols-2 gap-6">
            <div>
                <h3 class="text-gray-500 text-sm mb-1">Total Expenses</h3>
                <p class="text-2xl font-bold text-red-600">₹{{ number_format($totalExpenses, 2) }}</p>
            </div>
            <div>
                <!-- Category Breakdown -->
                <h3 class="text-gray-500 text-sm mb-2">Expenses by Category</h3>
                <div class="space-y-2">
                    @foreach($expensesByCategory as $expense)
                    <div class="flex justify-between items-center">
                        <span class="text-sm">{{ $expense->category }}</span>
                        <span class="text-sm font-medium">₹{{ number_format($expense->total, 2) }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="bg-white rounded-2xl shadow-md p-4 mb-6">
        <div class="flex flex-wrap items-center gap-4">
            <div class="flex-grow">
                <input type="text" wire:model.live.debounce.300ms="searchTerm" 
                       class="border rounded-lg px-4 py-2 w-full" 
                       placeholder="Search expenses...">
            </div>
            <div>
                <select wire:model.live="filter" 
                        class="border rounded-lg px-4 py-2">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}">{{ $category }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <!-- Expenses Table -->
    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left">Description</th>
                    <th class="px-4 py-3 text-left">Amount</th>
                    <th class="px-4 py-3 text-left">Date</th>
                    <th class="px-4 py-3 text-left">Category</th>
                    <th class="px-4 py-3 text-left">Approved By</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($expenses as $expense)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $expense->description }}</td>
                    <td class="px-4 py-3 font-medium text-red-600">₹{{ number_format($expense->amount, 2) }}</td>
                    <td class="px-4 py-3">{{ $expense->date->format('d M, Y') }}</td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs rounded-full">
                            {{ $expense->category }}
                        </span>
                    </td>
                    <td class="px-4 py-3">{{ $expense->approved_by ?? '—' }}</td>
                    <td class="px-4 py-3 text-center">
                        <button wire:click="editExpense({{ $expense->id }})" class="text-blue-600 hover:text-blue-800 mr-3">
                            <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </button>
                        <button wire:click="deleteExpense({{ $expense->id }})" 
                                class="text-red-600 hover:text-red-800"
                                onclick="return confirm('Are you sure you want to delete this expense?')">
                            <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-4">
            {{ $expenses->links() }}
        </div>
    </div>

    <!-- Expense Modal -->
    @if($showModal)
    <div class="fixed inset-0 flex items-center justify-center z-50">
        <div class="fixed inset-0 bg-black opacity-50"></div>
        <div class="bg-white p-6 rounded-lg shadow-lg z-10 w-full max-w-md">
            <h2 class="text-lg font-bold mb-4">{{ $expenseId ? 'Edit' : 'Add' }} Expense</h2>
            
            <form wire:submit.prevent="saveExpense">
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <input type="text" wire:model="description" id="description" 
                           class="w-full border-gray-300 rounded-md shadow-sm">
                    @error('description') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
                
                <div class="mb-4">
                    <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">Amount (₹)</label>
                    <input type="number" step="0.01" wire:model="amount" id="amount" 
                           class="w-full border-gray-300 rounded-md shadow-sm">
                    @error('amount') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
                
                <div class="mb-4">
                    <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                    <input type="date" wire:model="date" id="date" 
                           class="w-full border-gray-300 rounded-md shadow-sm">
                    @error('date') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
                
                <div class="mb-4">
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select wire:model="category" id="category" 
                            class="w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">Select Category</option>
                        <option value="Utilities">Utilities</option>
                        <option value="Rent">Rent</option>
                        <option value="Events">Events</option>
                        <option value="Maintenance">Maintenance</option>
                        <option value="Supplies">Supplies</option>
                        <option value="Food">Food</option>
                        <option value="Transportation">Transportation</option>
                        <option value="Charity">Charity</option>
                        <option value="Other">Other</option>
                    </select>
                    @error('category') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
                
                <div class="mb-4">
                    <label for="approved_by" class="block text-sm font-medium text-gray-700 mb-1">Approved By</label>
                    <input type="text" wire:model="approved_by" id="approved_by" 
                           class="w-full border-gray-300 rounded-md shadow-sm">
                </div>
                
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" wire:click="closeModal" 
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        {{ $expenseId ? 'Update' : 'Save' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>