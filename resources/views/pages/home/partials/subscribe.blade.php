<div class="bg-gray-100 dark:bg-gray-900">
    <div class="grid container mx-auto grid-cols-1 md:grid-cols-2 ">
        <!-- Left Side - Form -->
        <div class="flex items-center justify-center ">
            <div class="  p-8 w-full  rounded-3xl bg-white dark:bg-gray-100">
                <h2 class="text-2xl text-gray-900 font-bold  mb-2">Đăng ký tư vấn mua xe</h2>
                <p class="text-gray-500 text-sm mb-6">
                    Điền thông tin của bạn để nhận tư vấn chi tiết và đăng ký lái thử xe.
                </p>

                <form class="space-y-4 grid grid-cols-2 gap-3 ">
                    <div>
                        <label class="block text-brand-black text-sm mb-1">Họ và tên</label>
                        <input type="text" placeholder="Nguyễn Văn A"
                            class="w-full px-3 text-brand-black py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500">
                    </div>

                    <div>
                        <label class="block text-brand-black text-sm mb-1">Số điện thoại</label>
                        <input type="tel" placeholder="090xxxxxxx"
                            class="w-full px-3 text-brand-black py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500">
                    </div>

                    <div>
                        <label class="block text-brand-black text-sm mb-1">Email</label>
                        <input type="email" placeholder="email@example.com"
                            class="w-full px-3 text-brand-black py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500">
                    </div>

                    <div>
                        <label class="block text-brand-black text-sm mb-1">Dòng xe quan tâm</label>
                        <select
                            class="w-full px-3 text-brand-black py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <option>Chọn xe</option>
                            <option>Audi e-tron GT</option>
                            <option>Mercedes C-Class</option>
                            <option>BMW 3 Series</option>
                            <option>Toyota Camry</option>
                        </select>
                    </div>

                    <button type="submit"
                        class="w-full bg-purple-600 hover:bg-purple-700 text-white py-2 rounded-lg font-semibold transition">
                        Đăng ký ngay
                    </button>
                </form>
            </div>
        </div>

        <!-- Right Side - Image -->
        <div class="hidden md:block p-5">
            <img src="https://images.unsplash.com/photo-1511919884226-fd3cad34687c?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                alt="Car Loan" class="w-full h-full object-cover rounded-2xl">
        </div>
    </div>
</div>
