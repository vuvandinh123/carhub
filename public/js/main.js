
function toggleBookmark(carId, title, price, year, fuel, mileage, bodytype, image) {
    let bookmarks = JSON.parse(localStorage.getItem('savedCars') || '[]');
    const carIndex = bookmarks.findIndex(car => car.id === carId);

    if (carIndex > -1) {
        // Remove from bookmarks
        bookmarks.splice(carIndex, 1);
        localStorage.setItem('savedCars', JSON.stringify(bookmarks));
        updateBookmarkUI(carId, false);
        showToast('Đã xóa khỏi danh sách yêu thích', 'info');
    } else {
        // Add to bookmarks
        bookmarks.push({
            id: carId,
            title: title,
            price: price,
            year: year,
            fuel: fuel,
            mileage: mileage,
            bodytype: bodytype,
            image: image,
            savedAt: new Date().toISOString()
        });
        localStorage.setItem('savedCars', JSON.stringify(bookmarks));
        updateBookmarkUI(carId, true);
        showToast('Đã lưu xe vào danh sách yêu thích', 'success');
    }

    updateBookmarkCount();
}

function updateBookmarkUI(carId, isBookmarked) {
    $(`.bookmark-btn-${carId}`).each(function () {
        if (isBookmarked) {
            $(this).addClass('active').attr('title', 'Bỏ lưu xe');
        } else {
            $(this).removeClass('active').attr('title', 'Lưu xe');
        }
    });
}

function updateBookmarkCount() {
    const bookmarks = JSON.parse(localStorage.getItem('savedCars') || '[]');
    $('.bookmark-count').text(bookmarks.length);
}

function initializeBookmarks() {
    const bookmarks = JSON.parse(localStorage.getItem('savedCars') || '[]');
    $.each(bookmarks, function (index, car) {
        updateBookmarkUI(car.id, true);
    });
    updateBookmarkCount();
}

function showToast(message, type = 'info', duration = 3000) {
    let $container = $('#toast-container');

    if ($container.length === 0) {
        $container = $('<div>', {
            id: 'toast-container',
            class: 'fixed top-5 right-5 z-50 flex flex-col gap-3 w-[250px]'
        }).appendTo('body');
    }

    const config = {
        success: {
            bg: 'from-primary-500 to-primary-600',
            icon: 'check-circle'
        },
        error: {
            bg: 'from-red-500 to-rose-600',
            icon: 'x-circle'
        },
        info: {
            bg: 'from-blue-500 to-indigo-600',
            icon: 'info'
        },
        warning: {
            bg: 'from-yellow-400 to-orange-500',
            icon: 'alert-triangle'
        }
    };

    const { bg, icon } = config[type] || config.info;

    const $toast = $(`
        <div class="
            relative overflow-hidden
            bg-gradient-to-r ${bg}
            text-white
            rounded-sm shadow-2xl
            px-5 py-4
            flex items-start gap-4
            animate-toast-in
        ">
            <!-- Icon -->
            <div class="shrink-0 bg-white/20 rounded-full p-2">
                <i data-lucide="${icon}" class="w-5 h-5"></i>
            </div>

            <!-- Content -->
            <div class="flex-1 text-sm leading-relaxed">
                ${message}
            </div>

            <!-- Close -->
            <button class="toast-close absolute top-2 right-2 opacity-70 hover:opacity-100 transition">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>

            <!-- Progress bar -->
            <div class="absolute bottom-0 left-0 h-[3px] bg-white/40 toast-progress"></div>
        </div>
    `).appendTo($container);

    // Init icons
    if (window.lucide) lucide.createIcons();

    // Animate progress bar
    $toast.find('.toast-progress').animate({ width: '100%' }, duration, 'linear');

    // Close handler
    const removeToast = () => {
        $toast.addClass('animate-toast-out');
        setTimeout(() => $toast.remove(), 300);
    };

    $toast.find('.toast-close').on('click', removeToast);

    setTimeout(removeToast, duration);
}

$(function () {
    const $contactToggle = $('#contactToggle');
    const $contactButtons = $('#contactButtons');
    let isOpen = false;

    // Toggle contact buttons
    $contactToggle.on('click', function (e) {
        e.stopPropagation(); // tránh bị document click bắt luôn

        isOpen = !isOpen;

        if (isOpen) {
            $contactButtons.addClass('show');
            $contactToggle.addClass('active');

            // Prevent body scroll on mobile
            if ($(window).width() <= 768) {
                $('body').css('overflow', 'hidden');
            }
        } else {
            closeContacts();
        }
    });

    // Close when clicking outside
    $(document).on('click', function (e) {
        if (!$(e.target).closest('.floating-contacts').length && isOpen) {
            closeContacts();
        }
    });

    function closeContacts() {
        $contactButtons.removeClass('show');
        $contactToggle.removeClass('active');
        $('body').css('overflow', 'auto');
        isOpen = false;
    }
});



// Initialize bookmarks on page load
$(document).ready(function () {
    initializeBookmarks();
});