<x-modal id="register-modal" title="Đăng ký tư vấn mua xe" buttonText="Đăng ký đặt xe">
    <form action="" method="POST" class="space-y-4">
        @csrf
        <!-- Họ và tên -->
        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Họ và tên <span class="text-red-500">*</span>
            </label>
            <input type="text" name="name" id="name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                       focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                       dark:bg-brand-gray dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                placeholder="Nguyễn Văn A" required>
        </div>

        <!-- Số điện thoại -->
        <div>
            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Số điện thoại <span class="text-red-500">*</span>
            </label>
            <input type="tel" name="phone" id="phone"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                       focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                       dark:bg-brand-gray dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                placeholder="0912345678" required>
        </div>

        <!-- Loại xe quan tâm -->
        <div>
            <label for="car_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Loại xe quan tâm
            </label>
            <select id="car_type" name="car_type"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                       focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                       dark:bg-brand-gray dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                <option value="">-- Chọn loại xe --</option>
                <option value="suv">SUV</option>
                <option value="sedan">Sedan</option>
                <option value="pickup">Pickup</option>
                <option value="hatchback">Hatchback</option>
                <option value="cuv">CUV</option>
                <option value="mpv">MPV</option>
            </select>
        </div>

        <!-- Ghi chú -->
        <div>
            <label for="note" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Ghi chú thêm
            </label>
            <textarea id="note" name="note" rows="3"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                       focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                       dark:bg-brand-gray dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                placeholder="Ví dụ: tôi muốn tư vấn mua xe cho gia đình 5 người..."></textarea>
        </div>

        <!-- Nút gửi -->
        <button type="submit"
            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 
                   focus:outline-none focus:ring-blue-300 font-medium rounded-lg 
                   text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 
                   dark:focus:ring-blue-800">
            Gửi đăng ký
        </button>
    </form>
</x-modal>
