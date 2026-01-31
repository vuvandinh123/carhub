<div id="register-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-main rounded-2xl shadow-2xl border border-gray-200 dark:border-gray-700 overflow-hidden">
            <!-- Decorative Header Background -->
            <div class="absolute top-0 left-0 right-0 h-24 bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 opacity-10"></div>
            
            <!-- Modal header -->
            <div class="relative flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                        <i data-lucide="car" class="w-6 h-6 text-white"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-main">Đăng Ký Tư Vấn</h3>
                        <p class="text-xs text-sub">Liên hệ trong 24h</p>
                    </div>
                </div>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white transition-all" data-modal-hide="register-modal">
                    <i data-lucide="x" class="w-4 h-4"></i>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <!-- Modal body -->
            <div class="p-5">
                <form action="" method="POST" class="space-y-4">
                    @csrf
                    
                    <!-- Họ và tên -->
                    <div>
                        <label for="name" class="block mb-1.5 text-sm font-semibold text-main flex items-center gap-2">
                            <i data-lucide="user" class="w-3.5 h-3.5 text-blue-600"></i>
                            Họ và tên <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name"
                            class="bg-main-gray border-2 border-gray-200 text-main text-sm rounded-lg 
                                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                                   dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 
                                   transition-all duration-300 hover:border-blue-300"
                            placeholder="Nguyễn Văn A" required>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <!-- Số điện thoại -->
                        <div>
                            <label for="phone" class="block mb-1.5 text-sm font-semibold text-main flex items-center gap-2">
                                <i data-lucide="phone" class="w-3.5 h-3.5 text-green-600"></i>
                                Số điện thoại <span class="text-red-500">*</span>
                            </label>
                            <input type="tel" name="phone" id="phone"
                                class="bg-main-gray border-2 border-gray-200 text-main text-sm rounded-lg 
                                       focus:ring-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                                       dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 
                                       transition-all duration-300 hover:border-blue-300"
                                placeholder="0912345678" required>
                        </div>

                        <!-- Loại xe -->
                        <div>
                            <label for="car_type" class="block mb-1.5 text-sm font-semibold text-main flex items-center gap-2">
                                <i data-lucide="car-front" class="w-3.5 h-3.5 text-orange-600"></i>
                                Loại xe
                            </label>
                            <div class="relative">
                                <select id="car_type" name="car_type"
                                    class="bg-main-gray border-2 border-gray-200 text-main text-sm rounded-lg 
                                           focus:ring-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                                           dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 
                                           transition-all duration-300 hover:border-blue-300 appearance-none cursor-pointer">
                                    <option value="">Chọn loại</option>
                                    <option value="suv">SUV</option>
                                    <option value="sedan">Sedan</option>
                                    <option value="pickup">Pickup</option>
                                    <option value="hatchback">Hatchback</option>
                                    <option value="mpv">MPV</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                    <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ngân sách -->
                    <div>
                        <label for="budget" class="block mb-1.5 text-sm font-semibold text-main flex items-center gap-2">
                            <i data-lucide="wallet" class="w-3.5 h-3.5 text-yellow-600"></i>
                            Ngân sách dự kiến
                        </label>
                        <div class="relative">
                            <select id="budget" name="budget"
                                class="bg-main-gray border-2 border-gray-200 text-main text-sm rounded-lg 
                                       focus:ring-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                                       dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 
                                       transition-all duration-300 hover:border-blue-300 appearance-none cursor-pointer">
                                <option value="">Chọn ngân sách</option>
                                <option value="under-500">Dưới 500 triệu</option>
                                <option value="500-1200">500 triệu - 1.2 tỷ</option>
                                <option value="1200-2000">1.2 - 2 tỷ</option>
                                <option value="over-2000">Trên 2 tỷ</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Ghi chú -->
                    <div>
                        <label for="note" class="block mb-1.5 text-sm font-semibold text-main flex items-center gap-2">
                            <i data-lucide="message-square" class="w-3.5 h-3.5 text-pink-600"></i>
                            Ghi chú
                        </label>
                        <textarea id="note" name="note" rows="2"
                            class="bg-main-gray border-2 border-gray-200 text-main text-sm rounded-lg 
                                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                                   dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 
                                   transition-all duration-300 hover:border-blue-300 resize-none"
                            placeholder="Nhu cầu sử dụng xe..."></textarea>
                    </div>

                    <!-- Benefits Info (compact) -->
                    <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-3 border border-blue-200 dark:border-blue-800">
                        <div class="flex items-center gap-4 text-xs text-sub">
                            <span class="flex items-center gap-1.5">
                                <i data-lucide="check-circle" class="w-3.5 h-3.5 text-green-600"></i>
                                Tư vấn miễn phí
                            </span>
                            <span class="flex items-center gap-1.5">
                                <i data-lucide="check-circle" class="w-3.5 h-3.5 text-green-600"></i>
                                Hỗ trợ vay 80%
                            </span>
                            <span class="flex items-center gap-1.5">
                                <i data-lucide="check-circle" class="w-3.5 h-3.5 text-green-600"></i>
                                Giảm giá đặc biệt
                            </span>
                        </div>
                    </div>

                    <!-- Nút gửi -->
                    <button type="submit"
                        class="w-full text-white bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 
                               focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded-lg 
                               text-sm px-5 py-3 text-center dark:focus:ring-blue-800 
                               transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-[1.02]
                               flex items-center justify-center gap-2">
                        <i data-lucide="send" class="w-4 h-4"></i>
                        Gửi Đăng Ký Ngay
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

