 <!-- Car Loan Calculator Section -->
 {{-- dịch qua tiếng việt --}}
 <div class="mt-24 max-w-4xl mx-auto">
     <div class="text-center mb-12">
         <h2 class="text-4xl font-bold text-gray-900 mb-4">Máy Tính Khoản Vay Xe Hơi</h2>
         <p class="text-gray-600 text-lg">Tính toán khoản thanh toán hàng tháng cho khoản vay xe hơi của bạn với máy tính dễ sử dụng của chúng tôi</p>
     </div>

     <div class="bg-white rounded-3xl shadow-xl p-8 lg:p-12">
         <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
             <!-- Input Form -->
             <div class="space-y-6">
                 <h3 class="text-2xl font-semibold text-gray-900 mb-6">Chi Tiết Khoản Vay</h3>

                 <!-- Car Price -->
                 <div>
                     <label class="block text-sm font-medium text-gray-700 mb-2">Giá Xe ($)</label>
                     <input type="number" id="carPrice" placeholder="25,000"
                         class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all text-lg">
                 </div>

                 <!-- Down Payment -->
                 <div>
                     <label class="block text-sm font-medium text-gray-700 mb-2">Tiền Đặt Cọc ($)</label>
                     <input type="number" id="downPayment" placeholder="5,000"
                         class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all text-lg">
                 </div>

                 <!-- Loan Term -->
                 <div>
                     <label class="block text-sm font-medium text-gray-700 mb-2">Thời Hạn Vay (tháng)</label>
                     <select id="loanTerm"
                         class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all text-lg">
                         <option value="12">12 tháng</option>
                         <option value="24">24 tháng</option>
                         <option value="36" selected>36 tháng</option>
                         <option value="48">48 tháng</option>
                         <option value="60">60 tháng</option>
                         <option value="72">72 tháng</option>
                     </select>
                 </div>

                 <!-- Interest Rate -->
                 <div>
                     <label class="block text-sm font-medium text-gray-700 mb-2">Lãi Suất (%)</label>
                     <input type="number" id="interestRate" placeholder="5.5" step="0.1"
                         class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all text-lg">
                 </div>

                 <!-- Calculate Button -->
                 <button id="calculateBtn"
                     class="w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold py-4 px-6 rounded-xl shadow-lg transform hover:scale-105 transition-all duration-200 text-lg">
                     Tính Toán Khoản Thanh Toán Hàng Tháng
                 </button>
             </div>

             <!-- Results -->
             <div class="bg-gradient-to-br from-purple-50 to-blue-50 rounded-2xl p-8">
                 <h3 class="text-2xl font-semibold text-gray-900 mb-6">Tóm Tắt Khoản Thanh Toán</h3>

                 <div class="space-y-4">
                     <!-- Monthly Payment -->
                     <div class="bg-white rounded-xl p-6 shadow-sm">
                         <div class="text-sm text-gray-600 mb-1">Khoản Thanh Toán Hàng Tháng</div>
                         <div id="monthlyPayment" class="text-3xl font-bold text-purple-600">$0</div>
                     </div>

                     <!-- Loan Amount -->
                     <div class="bg-white rounded-xl p-4 shadow-sm">
                         <div class="flex justify-between items-center">
                             <span class="text-gray-600">Số Tiền Vay</span>
                             <span id="loanAmount" class="font-semibold text-gray-900">$0</span>
                         </div>
                     </div>

                     <!-- Total Interest -->
                     <div class="bg-white rounded-xl p-4 shadow-sm">
                         <div class="flex justify-between items-center">
                             <span class="text-gray-600">Tổng Lãi Suất</span>
                             <span id="totalInterest" class="font-semibold text-gray-900">$0</span>
                         </div>
                     </div>

                     <!-- Total Payment -->
                     <div class="bg-white rounded-xl p-4 shadow-sm">
                         <div class="flex justify-between items-center">
                             <span class="text-gray-600">Tổng Khoản Thanh Toán</span>
                             <span id="totalPayment" class="font-semibold text-gray-900">$0</span>
                         </div>
                     </div>
                 </div>

                 <!-- Additional Info -->
                 <div class="mt-6 p-4 bg-blue-50 rounded-xl">
                     <div class="flex items-start">
                         <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                             <path fill-rule="evenodd"
                                 d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                 clip-rule="evenodd"></path>
                         </svg>
                         <div class="text-sm text-blue-800">
                             <div class="font-medium mb-1">Ghi Chú:</div>
                             <div>Đây là ước tính. Lãi suất thực tế có thể thay đổi dựa trên điểm tín dụng và các yếu tố khác.
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
