/**
 * 이사업체 상세
 */
(function () {
    'use strict';

    const heartIcon = document.querySelector('#heartIcon');

    document.addEventListener('DOMContentLoaded', () => {
        eventListeners();
    });

    function eventListeners() {
        heartIcon.addEventListener('click', toggleLike);
    }

    function toggleLike(e) {
        e.preventDefault();

    }

})();