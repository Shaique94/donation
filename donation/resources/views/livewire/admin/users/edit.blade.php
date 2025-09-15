<div class="max-w-lg mx-auto bg-white p-6 rounded-2xl shadow-md">
    @if (session()->has('success'))
        <div class="mb-4 p-3 text-green-700 bg-green-100 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="updateUser" class="space-y-6">

        <!-- Name -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Name <span class="text-red-500">*</span></label>
            <input type="text" wire:model="name"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <!-- Email -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Email <span class="text-red-500">*</span></label>
            <input type="email" wire:model="email"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            @error('email') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

       

        <!-- Role -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Role <span class="text-red-500">*</span></label>
            <select wire:model="role"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                <option value="">-- Select a Role --</option>
                <option value="admin">Admin</option>
                <option value="member">Member</option>
                <option value="user">User</option>
            </select>
            @error('role') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <!-- Plan Selection -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Assign Plan </label>
            <select wire:model="plan_id"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                <option value="">-- Select a Plan --</option>
                @foreach($this->plans as $plan)
                    <option value="{{ $plan->id }}">{{ $plan->name }} (₹{{ $plan->amount_required }})</option>
                @endforeach
            </select>
            @error('plan_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <!-- Buttons -->
        <div class="flex justify-between pt-6 border-t">
            <a href=""
                class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 text-gray-700">
                Cancel
            </a>

            <button type="submit"
                class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Update User
            </button>
        </div>
    </form>
</div>
