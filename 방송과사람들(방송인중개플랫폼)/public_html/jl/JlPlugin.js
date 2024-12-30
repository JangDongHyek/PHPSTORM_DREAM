class JlPlugin {
    constructor(jl) {
        this.jl = jl;
    }

    async alert(message, options = {}) {
        this.jl.checkPlugin("swal");

        const defaultOptions = {
            title: message,
            icon: "info",
            confirmButtonText: "확인"
        }

        await Swal.fire({ ...defaultOptions, ...options });
    }

    async confirm(message, options = {}) {
        this.jl.checkPlugin("swal");

        const defaultOptions = {
            title: message,
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "확인",
            cancelButtonText: "취소"
        };

        const result = await Swal.fire({ ...defaultOptions, ...options });

        return result.isConfirmed; // 확인: true, 취소: false
    }


}