class PartCommon {
    constructor(jl) {
        this.jl = jl;
    }

    getBlockRowspan(block) {
        if(block.$floors.length == 0) return 5;

        let rowspan = 0;
        for (const floor of block.$floors) {
            rowspan += this.getFloorRowspan(floor);
        }

        return rowspan
    }

    getFloorRowspan(floor) {
        if(floor.$areas.length == 0) return 1;

        return  floor.$areas.length;
    }

    checkData(rows) {
        for (const block of rows) {
            if(block.status == 'update') {
                return true;
            }

            for (const floor of block.$floors) {
                if(floor.status == 'update') {
                    return true;
                }

                for (const area of floor.$areas) {
                    if(area.status == 'update') {
                        return true;
                    }
                }
            }
        }

        return false;
    }
}

window.PartCommon = PartCommon;