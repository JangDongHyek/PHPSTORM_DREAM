(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', () => {
        // 검색
        if (typeof window.initSearch === 'function') window.initSearch();
    });
})();