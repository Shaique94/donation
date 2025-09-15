<div class="container mx-auto py-6 px-4 sm:px-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <h1 class="text-2xl font-bold text-gray-800">Plans</h1>
        <a href="{{ route('admin.plan.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow whitespace-nowrap">
           + Create New Plan
        </a>
    </div>

    <!-- Mobile Plan Cards (visible on small screens) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:hidden gap-4 mb-6">
        @forelse($plans as $plan)
            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex justify-between items-center mb-2">
                    <h3 class="font-semibold text-lg">{{ $plan->name }}</h3>
                    <span class="px-2 py-1 rounded-full text-xs {{ $plan->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $plan->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
                <div class="text-xl font-bold text-blue-600 mb-2">₹{{ number_format($plan->amount, 2) }}</div>
                @if($plan->description)
                    <p class="text-gray-600 text-sm mb-3">{{ Str::limit($plan->description, 100) }}</p>
                @endif
                <div class="text-gray-500 text-sm mb-3">{{ $plan->user_count }} Members</div>
                
                <div class="flex justify-end space-x-2 mt-2">
                    <button wire:click="togglePlanStatus({{ $plan->id }})" 
                            class="{{ $plan->is_active ? 'text-red-600' : 'text-green-600' }} text-sm">
                        {{ $plan->is_active ? 'Deactivate' : 'Activate' }}
                    </button>
                    <a href="{{ route('admin.plan.edit', $plan->id) }}" class="text-blue-600 text-sm">Edit</a>
                    @if($plan->user_count == 0)
                        <button wire:click="confirmDelete({{ $plan->id }})" class="text-red-600 text-sm">
                            Delete
                        </button>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-lg p-6 text-center text-gray-500">
                No plans found. Create your first plan!
            </div>
        @endforelse
    </div>

    <!-- Table (visible on larger screens) -->
    <div class="hidden lg:block bg-white shadow rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-gray-700 text-sm uppercase">
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Amount</th>
                        <th class="px-4 py-3">Description</th>
                        <th class="px-4 py-3">Members</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm divide-y divide-gray-200">
                    @forelse($plans as $plan)
                        <tr>
                            <td class="px-4 py-3 font-medium">{{ $plan->name }}</td>
                            <td class="px-4 py-3 font-medium text-blue-600">₹{{ number_format($plan->amount, 2) }}</td>
                            <td class="px-4 py-3">{{ Str::limit($plan->description ?? '—', 50) }}</td>
                            <td class="px-4 py-3">{{ $plan->user_count }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 rounded-full text-xs {{ $plan->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $plan->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-right">
                                <button wire:click="togglePlanStatus({{ $plan->id }})" 
                                        class="{{ $plan->is_active ? 'text-red-600' : 'text-green-600' }} mr-2">
                                    {{ $plan->is_active ? 'Deactivate' : 'Activate' }}
                                </button>
                                <a href="{{ route('admin.plan.edit', $plan->id) }}" class="text-blue-600 mr-2">Edit</a>
                                @if($plan->user_count == 0)
                                    <button wire:click="confirmDelete({{ $plan->id }})" class="text-red-600">
                                        Delete
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                                No plans found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    @if($showDeleteModal)
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <!-- Modal panel -->
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <!-- Warning icon -->
                            <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Delete Plan</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">Are you sure you want to delete this plan? This action cannot be undone.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button wire:click="deletePlan" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">Delete</button>
                    <button wire:click="$set('showDeleteModal', false)" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    @endif
    
    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="fixed bottom-4 right-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 z-50" role="alert">
            <p>{{ session('message') }}</p>
        </div>
    @endif
    
    @if (session()->has('error'))
        <div class="fixed bottom-4 right-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 z-50" role="alert">
            <p>{{ session('error') }}</p>
        </div>
    @endif
</div>