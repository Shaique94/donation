<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Users & Plans</h1>
        <button wire:click="openCreateUserModal"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            + Add User
        </button>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-4 rounded-2xl shadow-md text-center">
            <p class="text-sm text-gray-500">Total Users</p>
            <h3 class="text-xl font-bold">{{ $totalUsers }}</h3>
        </div>
        <div class="bg-white p-4 rounded-2xl shadow-md text-center">
            <p class="text-sm text-gray-500">Active Plans</p>
            <h3 class="text-xl font-bold text-green-600">{{ $activePlans }}</h3>
        </div>
        <div class="bg-white p-4 rounded-2xl shadow-md text-center">
            <p class="text-sm text-gray-500">Expired Plans</p>
            <h3 class="text-xl font-bold text-red-600">{{ $expiredPlans }}</h3>
        </div>
        <div class="bg-white p-4 rounded-2xl shadow-md text-center">
            <p class="text-sm text-gray-500">Revenue</p>
            <h3 class="text-xl font-bold">₹{{ number_format($revenue, 2) }}</h3>
        </div>
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left">Name</th>
                    <th class="px-4 py-3 text-left">Email</th>
                    <th class="px-4 py-3 text-left">Role</th>
                    <th class="px-4 py-3 text-left">Plan</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-left">Start</th>
                    <th class="px-4 py-3 text-left">End</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                @php
                    $plan = $user->plans->first();
                @endphp
                <tr class="border-b">
                    <td class="px-4 py-3">{{ $user->name }}</td>
                    <td class="px-4 py-3">{{ $user->email }}</td>
                    <td class="px-4 py-3">{{ ucfirst($user->role) }}</td>
                    <td class="px-4 py-3">{{ $plan?->name ?? '—' }}</td>
                    <td class="px-4 py-3">
                        @if($plan?->pivot->status === 'active')
                            <span class="text-green-600 font-medium">Active</span>
                        @elseif($plan)
                            <span class="text-red-600 font-medium">Expired</span>
                        @else
                            —
                        @endif
                    </td>
                    <td class="px-4 py-3">{{ $plan?->pivot->start_date }}</td>
                    <td class="px-4 py-3">{{ $plan?->pivot->end_date ?? '—' }}</td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

 
</div>
