<div class="container mx-auto p-6">
    <!-- Header with decorative elements -->
    <div class="relative mb-12 pb-4 border-b border-gray-200">
        <h1 class="text-3xl font-bold text-gray-800 flex items-center">
            <svg class="w-8 h-8 mr-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM14 11a1 1 0 011 1v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0v-1h-1a1 1 0 110-2h1v-1a1 1 0 011-1z"/>
            </svg>
            Bazm-e-Haidri Reports Dashboard
        </h1>
        <p class="text-gray-600 text-lg mt-2 ml-11">Comprehensive financial analytics and reporting tools</p>
        
        <!-- Date Filter -->
        <div class="absolute right-0 top-0 flex items-center space-x-3">
            <div class="relative">
                <select class="bg-white border border-gray-300 text-gray-700 py-2 pl-3 pr-8 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    <option>All Time</option>
                    <option>This Month</option>
                    <option>Last 3 Months</option>
                    <option>This Year</option>
                    <option selected>2025</option>
                    <option>2024</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
            <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition flex items-center">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                </svg>
                Refresh Data
            </button>
        </div>
    </div>

    <!-- Financial Highlights Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-2xl shadow-md border border-green-200">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-gray-600 font-medium">Total Donations</h3>
                    <p class="text-3xl font-bold text-green-600 mt-1">₹9,75,000</p>
                    <div class="flex items-center mt-2 text-green-700">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm">+14.2% vs last year</span>
                    </div>
                </div>
                <div class="p-3 bg-white bg-opacity-80 rounded-full">
                    <svg class="w-8 h-8 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <div class="h-2 w-full bg-gray-200 rounded-full overflow-hidden">
                    <div class="h-full bg-green-500 rounded-full" style="width: 85%"></div>
                </div>
                <div class="flex justify-between text-xs text-gray-500 mt-1">
                    <span>Target: ₹12,00,000</span>
                    <span>85% complete</span>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-red-50 to-red-100 p-6 rounded-2xl shadow-md border border-red-200">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-gray-600 font-medium">Total Expenses</h3>
                    <p class="text-3xl font-bold text-red-600 mt-1">₹6,23,500</p>
                    <div class="flex items-center mt-2 text-red-700">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12 13a1 1 0 100 2h5a1 1 0 001-1V9a1 1 0 10-2 0v2.586l-4.293-4.293a1 1 0 00-1.414 0L8 9.586 3.707 5.293a1 1 0 00-1.414 1.414l5 5a1 1 0 001.414 0L11 9.414 14.586 12H12z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm">+8.7% vs last year</span>
                    </div>
                </div>
                <div class="p-3 bg-white bg-opacity-80 rounded-full">
                    <svg class="w-8 h-8 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <div class="h-2 w-full bg-gray-200 rounded-full overflow-hidden">
                    <div class="h-full bg-red-500 rounded-full" style="width: 62%"></div>
                </div>
                <div class="flex justify-between text-xs text-gray-500 mt-1">
                    <span>Budget: ₹10,00,000</span>
                    <span>62% utilized</span>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-2xl shadow-md border border-blue-200">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-gray-600 font-medium">Net Balance</h3>
                    <p class="text-3xl font-bold text-blue-600 mt-1">₹3,51,500</p>
                    <div class="flex items-center mt-2 text-blue-700">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm">+21.3% vs last year</span>
                    </div>
                </div>
                <div class="p-3 bg-white bg-opacity-80 rounded-full">
                    <svg class="w-8 h-8 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-14a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 7.586V4z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <div class="h-2 w-full bg-gray-200 rounded-full overflow-hidden">
                    <div class="h-full bg-blue-500 rounded-full" style="width: 35%"></div>
                </div>
                <div class="flex justify-between text-xs text-gray-500 mt-1">
                    <span>Target Reserve: ₹10,00,000</span>
                    <span>35% achieved</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Report Generator Section -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition-shadow border border-gray-100">
            <div class="flex items-center mb-4">
                <div class="p-2 bg-green-100 rounded-lg mr-3">
                    <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm2 10a1 1 0 10-2 0v3a1 1 0 102 0v-3zm4-1a1 1 0 011 1v3a1 1 0 11-2 0v-3a1 1 0 011-1zm2-5a1 1 0 00-1 1v3a1 1 0 102 0V7a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800">Donation Reports</h3>
            </div>
            <p class="text-gray-600 mb-5">Generate comprehensive reports on donation analytics by time period, plan category, and member contributions.</p>
            
            <div class="space-y-3 mb-6">
                <div class="flex items-center">
                    <input id="donation_monthly" type="radio" name="donation_report_type" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                    <label for="donation_monthly" class="ml-2 block text-sm text-gray-700">Monthly Analysis</label>
                </div>
                <div class="flex items-center">
                    <input id="donation_plan" type="radio" name="donation_report_type" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded" checked>
                    <label for="donation_plan" class="ml-2 block text-sm text-gray-700">Plan Distribution</label>
                </div>
                <div class="flex items-center">
                    <input id="donation_member" type="radio" name="donation_report_type" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                    <label for="donation_member" class="ml-2 block text-sm text-gray-700">Member Contributions</label>
                </div>
            </div>
            
            <div class="flex flex-wrap space-x-2">
                <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1z" clip-rule="evenodd"/>
                        <path fill-rule="evenodd" d="M10.293 11.293a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 13.414V19a1 1 0 11-2 0v-5.586l-3.293 3.293a1 1 0 01-1.414-1.414l4-4z" clip-rule="evenodd"/>
                    </svg>
                    Generate Report
                </button>
                <div class="dropdown inline-block relative">
                    <button class="border border-green-600 text-green-600 px-4 py-2 rounded-lg hover:bg-green-50 transition flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                        Export
                        <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition-shadow border border-gray-100">
            <div class="flex items-center mb-4">
                <div class="p-2 bg-red-100 rounded-lg mr-3">
                    <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800">Expense Reports</h3>
            </div>
            <p class="text-gray-600 mb-5">Track and analyze organizational expenses across different categories, time periods, and approval status.</p>
            
            <div class="space-y-3 mb-6">
                <div class="flex items-center">
                    <input id="expense_category" type="radio" name="expense_report_type" class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded" checked>
                    <label for="expense_category" class="ml-2 block text-sm text-gray-700">Category Analysis</label>
                </div>
                <div class="flex items-center">
                    <input id="expense_trend" type="radio" name="expense_report_type" class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded">
                    <label for="expense_trend" class="ml-2 block text-sm text-gray-700">Monthly Trend</label>
                </div>
                <div class="flex items-center">
                    <input id="expense_approval" type="radio" name="expense_report_type" class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded">
                    <label for="expense_approval" class="ml-2 block text-sm text-gray-700">Approval Status</label>
                </div>
            </div>
            
            <div class="flex flex-wrap space-x-2">
                <button class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1z" clip-rule="evenodd"/>
                        <path fill-rule="evenodd" d="M10.293 11.293a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 13.414V19a1 1 0 11-2 0v-5.586l-3.293 3.293a1 1 0 01-1.414-1.414l4-4z" clip-rule="evenodd"/>
                    </svg>
                    Generate Report
                </button>
                <div class="dropdown inline-block relative">
                    <button class="border border-red-600 text-red-600 px-4 py-2 rounded-lg hover:bg-red-50 transition flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                        Export
                        <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition-shadow border border-gray-100">
            <div class="flex items-center mb-4">
                <div class="p-2 bg-blue-100 rounded-lg mr-3">
                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 000 2h14a1 1 0 100-2H3zm0 6a1 1 0 000 2h10a1 1 0 100-2H3zm0 6a1 1 0 100 2h5a1 1 0 000-2H3z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800">Financial Reports</h3>
            </div>
            <p class="text-gray-600 mb-5">Get comprehensive financial statements including balance sheets, income statements, and cash flow analyses.</p>
            
            <div class="space-y-3 mb-6">
                <div class="flex items-center">
                    <input id="financial_summary" type="radio" name="financial_report_type" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" checked>
                    <label for="financial_summary" class="ml-2 block text-sm text-gray-700">Summary Statement</label>
                </div>
                <div class="flex items-center">
                    <input id="financial_income" type="radio" name="financial_report_type" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="financial_income" class="ml-2 block text-sm text-gray-700">Income Statement</label>
                </div>
                <div class="flex items-center">
                    <input id="financial_cash" type="radio" name="financial_report_type" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="financial_cash" class="ml-2 block text-sm text-gray-700">Cash Flow Analysis</label>
                </div>
            </div>
            
            <div class="flex flex-wrap space-x-2">
                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1z" clip-rule="evenodd"/>
                        <path fill-rule="evenodd" d="M10.293 11.293a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 13.414V19a1 1 0 11-2 0v-5.586l-3.293 3.293a1 1 0 01-1.414-1.414l4-4z" clip-rule="evenodd"/>
                    </svg>
                    Generate Report
                </button>
                <div class="dropdown inline-block relative">
                    <button class="border border-blue-600 text-blue-600 px-4 py-2 rounded-lg hover:bg-blue-50 transition flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                        Export
                        <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Donation & Expense Chart -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
        <!-- Monthly Donation Trends -->
        <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-semibold text-gray-800">Monthly Donation Trends</h2>
                <div class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded flex items-center">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"/>
                    </svg>
                    14.2% growth
                </div>
            </div>
            
            <div class="relative h-60">
                <!-- This would typically be a chart - I'm showing a placeholder with bars -->
                <div class="absolute bottom-0 left-0 right-0 flex items-end justify-between h-48 px-2">
                    <div class="flex flex-col items-center">
                        <div class="w-10 bg-green-500 rounded-t-md mb-1" style="height: 30%"></div>
                        <span class="text-xs text-gray-500">Jan</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="w-10 bg-green-500 rounded-t-md mb-1" style="height: 45%"></div>
                        <span class="text-xs text-gray-500">Feb</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="w-10 bg-green-500 rounded-t-md mb-1" style="height: 65%"></div>
                        <span class="text-xs text-gray-500">Mar</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="w-10 bg-green-500 rounded-t-md mb-1" style="height: 40%"></div>
                        <span class="text-xs text-gray-500">Apr</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="w-10 bg-green-500 rounded-t-md mb-1" style="height: 80%"></div>
                        <span class="text-xs text-gray-500">May</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="w-10 bg-green-500 rounded-t-md mb-1" style="height: 60%"></div>
                        <span class="text-xs text-gray-500">Jun</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="w-10 bg-green-500 rounded-t-md mb-1" style="height: 75%"></div>
                        <span class="text-xs text-gray-500">Jul</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="w-10 bg-green-500 rounded-t-md mb-1" style="height: 90%"></div>
                        <span class="text-xs text-gray-500">Aug</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="w-10 bg-green-500 rounded-t-md mb-1" style="height: 85%"></div>
                        <span class="text-xs text-gray-500">Sep</span>
                    </div>
                </div>
                
                <!-- Horizontal grid lines -->
                <div class="absolute inset-0 flex flex-col justify-between pointer-events-none">
                    <div class="border-b border-gray-100 flex justify-between">
                        <span class="text-xs text-gray-400">₹100K</span>
                        <span class="text-xs text-gray-400 invisible">-</span>
                    </div>
                    <div class="border-b border-gray-100 flex justify-between">
                        <span class="text-xs text-gray-400">₹75K</span>
                        <span class="text-xs text-gray-400 invisible">-</span>
                    </div>
                    <div class="border-b border-gray-100 flex justify-between">
                        <span class="text-xs text-gray-400">₹50K</span>
                        <span class="text-xs text-gray-400 invisible">-</span>
                    </div>
                    <div class="border-b border-gray-100 flex justify-between">
                        <span class="text-xs text-gray-400">₹25K</span>
                        <span class="text-xs text-gray-400 invisible">-</span>
                    </div>
                    <div class="border-b border-gray-100 flex justify-between">
                        <span class="text-xs text-gray-400">₹0</span>
                        <span class="text-xs text-gray-400 invisible">-</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Expense by Category -->
        <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-semibold text-gray-800">Expense by Category</h2>
                <select class="text-sm border-gray-300 rounded-md">
                    <option>Last 12 Months</option>
                    <option>Last 6 Months</option>
                    <option>This Year</option>
                </select>
            </div>
            
            <!-- Placeholder for a pie/donut chart -->
            <div class="flex items-center justify-center">
                <div class="relative w-48 h-48">
                    <div class="absolute inset-0 rounded-full border-8 border-red-500" style="clip: rect(0, 48px, 96px, 0); transform: rotate(0deg);"></div>
                    <div class="absolute inset-0 rounded-full border-8 border-blue-500" style="clip: rect(0, 96px, 96px, 48px); transform: rotate(0deg);"></div>
                    <div class="absolute inset-0 rounded-full border-8 border-yellow-500" style="clip: rect(48px, 96px, 96px, 0); transform: rotate(0deg);"></div>
                    <div class="absolute inset-0 rounded-full border-8 border-green-500" style="clip: rect(48px, 48px, 96px, 0); transform: rotate(0deg);"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="bg-white rounded-full w-32 h-32"></div>
                    </div>
                </div>
                
                <div class="ml-8 space-y-3">
                    <div class="flex items-center">
                        <span class="w-3 h-3 bg-red-500 rounded-full mr-2"></span>
                        <span class="text-sm text-gray-600">Events (35%)</span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-3 h-3 bg-blue-500 rounded-full mr-2"></span>
                        <span class="text-sm text-gray-600">Maintenance (25%)</span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></span>
                        <span class="text-sm text-gray-600">Utilities (20%)</span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-3 h-3 bg-green-500 rounded-full mr-2"></span>
                        <span class="text-sm text-gray-600">Charity (20%)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Plan Distribution & Member Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <!-- Plan Distribution -->
        <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100 col-span-2">
            <h2 class="text-lg font-semibold text-gray-800 mb-6">Plan Distribution</h2>
            
            <div class="space-y-6">
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-amber-500 rounded-full mr-2"></div>
                            <span class="text-sm font-medium">Basic Plan - ₹3,000</span>
                        </div>
                        <span class="text-sm font-medium">65 members</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-amber-500 h-2 rounded-full" style="width: 45%"></div>
                    </div>
                    <div class="flex justify-between text-xs text-gray-500 mt-1">
                        <span>₹1,95,000 collected</span>
                        <span>45% of members</span>
                    </div>
                </div>
                
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-blue-500 rounded-full mr-2"></div>
                            <span class="text-sm font-medium">Standard Plan - ₹4,000</span>
                        </div>
                        <span class="text-sm font-medium">48 members</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-500 h-2 rounded-full" style="width: 32%"></div>
                    </div>
                    <div class="flex justify-between text-xs text-gray-500 mt-1">
                        <span>₹1,92,000 collected</span>
                        <span>32% of members</span>
                    </div>
                </div>
                
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-purple-500 rounded-full mr-2"></div>
                            <span class="text-sm font-medium">Premium Plan - ₹5,000</span>
                        </div>
                        <span class="text-sm font-medium">34 members</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-purple-500 h-2 rounded-full" style="width: 23%"></div>
                    </div>
                    <div class="flex justify-between text-xs text-gray-500 mt-1">
                        <span>₹1,70,000 collected</span>
                        <span>23% of members</span>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-center mt-6">
                <div class="inline-flex items-center bg-gray-100 rounded-lg p-1">
                    <button class="px-4 py-1.5 text-sm font-medium rounded-md bg-white shadow">This Year</button>
                    <button class="px-4 py-1.5 text-sm font-medium text-gray-500 hover:text-gray-700">Last Year</button>
                    <button class="px-4 py-1.5 text-sm font-medium text-gray-500 hover:text-gray-700">All Time</button>
                </div>
            </div>
        </div>
        
        <!-- Member Statistics -->
        <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Member Statistics</h2>
            
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div class="bg-gray-50 p-3 rounded-lg text-center">
                    <p class="text-gray-500 text-xs">Total Members</p>
                    <p class="text-xl font-bold text-gray-800">147</p>
                </div>
                <div class="bg-gray-50 p-3 rounded-lg text-center">
                    <p class="text-gray-500 text-xs">Active Plans</p>
                    <p class="text-xl font-bold text-green-600">124</p>
                </div>
                <div class="bg-gray-50 p-3 rounded-lg text-center">
                    <p class="text-gray-500 text-xs">Expired Plans</p>
                    <p class="text-xl font-bold text-red-600">23</p>
                </div>
                <div class="bg-gray-50 p-3 rounded-lg text-center">
                    <p class="text-gray-500 text-xs">Renewal Rate</p>
                    <p class="text-xl font-bold text-blue-600">84%</p>
                </div>
            </div>
            
            <div class="border-t pt-4">
                <h3 class="text-sm font-medium text-gray-700 mb-3">Top Contributors</h3>
                <ul class="space-y-2">
                    <li class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="w-6 h-6 rounded-full bg-gray-200 flex items-center justify-center text-xs font-medium text-gray-700 mr-2">A</div>
                            <span class="text-sm">Anand Sharma</span>
                        </div>
                        <span class="text-sm font-medium">₹12,000</span>
                    </li>
                    <li class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="w-6 h-6 rounded-full bg-gray-200 flex items-center justify-center text-xs font-medium text-gray-700 mr-2">R</div>
                            <span class="text-sm">Rajesh Kumar</span>
                        </div>
                        <span class="text-sm font-medium">₹10,000</span>
                    </li>
                    <li class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="w-6 h-6 rounded-full bg-gray-200 flex items-center justify-center text-xs font-medium text-gray-700 mr-2">P</div>
                            <span class="text-sm">Priya Patel</span>
                        </div>
                        <span class="text-sm font-medium">₹8,500</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
    <!-- Recent Transactions -->
    <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold text-gray-800">Recent Transactions</h2>
            <button class="text-blue-600 hover:text-blue-800 text-sm flex items-center">
                View All
                <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                </svg>
            </button>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">15 Sep, 2025</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">Donation from Anil Kapoor</td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Income</span>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-green-600 font-medium">+₹5,000</td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Completed</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">14 Sep, 2025</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">Event Venue Rental</td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs bg-red-100 text-red-800 rounded-full">Expense</span>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-red-600 font-medium">-₹15,000</td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Approved</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">12 Sep, 2025</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">Monthly Plan Payment - Sunita Sharma</td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Income</span>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-green-600 font-medium">+₹4,000</td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Completed</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">10 Sep, 2025</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">Utility Bills Payment</td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs bg-red-100 text-red-800 rounded-full">Expense</span>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-red-600 font-medium">-₹3,500</td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Approved</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">8 Sep, 2025</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">Donation from Vijay Mehta</td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Income</span>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-green-600 font-medium">+₹3,000</td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Completed</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>