class JlPlugin {
    constructor(jl) {
        this.jl = jl;
    }

    async alert(message, options = {}) {
        if(this.jl.isMobile()) {
            await this.toast(message,options);
            return false;
        }
        switch (this.jl.jl_alert) {
            case "origin" : {
                alert(message);
                break;
            }
            case "swal" : {
                await this.swalAlert(message,options);
                break;
            }
        }
    }

    async swalAlert(message, options = {}) {
        this.jl.checkPlugin("swal");

        const defaultOptions = {
            title: message,
            icon: null, // success,error,warning,question
            confirmButtonText: "확인"
        }

        await Swal.fire({ ...defaultOptions, ...options });
    }

    async confirm(message, options = {}) {
        switch (this.jl.jl_alert) {
            case "origin" : {
                return confirm(message);
            }
            case "swal" : {
                return await this.swalConfirm(message,options);
            }
        }
    }

    async swalConfirm(message, options = {}) {
        this.jl.checkPlugin("swal");

        const defaultOptions = {
            title: message,
            icon: null,
            showCancelButton: true,
            confirmButtonText: "확인",
            cancelButtonText: "취소"
        };

        const result = await Swal.fire({ ...defaultOptions, ...options });

        return result.isConfirmed; // 확인: true, 취소: false
    }

    async toast(message, options = {}) {
        switch (this.jl.jl_alert) {
            case "origin" : {
                //confirm(message);
                break;
            }
            case "swal" : {
                await this.swalToast(message,options);
                break;
            }
        }
    }

    async swalToast(message, options = {}) {
        this.jl.checkPlugin("swal");

        const defaultOptions = {
            toast: true,
            position: 'top-center',
            showConfirmButton: false,
            timer: options.duration || 1200,
            timerProgressBar: true,
        };

        const Toast = Swal.mixin(defaultOptions);

        await Toast.fire({
            title: message,
            icon: options.icon || null
        });
    }


}