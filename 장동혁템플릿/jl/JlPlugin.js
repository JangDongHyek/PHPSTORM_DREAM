class JlPlugin {
    constructor(jl) {
        this.jl = jl;
    }

    alert(content) {
        this.jl.checkPlugin("swal");

        Swal.fire(content);
    }


}