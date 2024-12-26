/**
 * 파일업로드
 */
const fileUploader = (function () {
    return {
        async single(input, target, createFolderType, maxMb, value = 'Y') {
            const resultData = {result: false};
            const file = input.files[0];
            if (file == undefined || !file) return resultData;

            resultData.originFileName = file.name;

            // 최대용량체크
            const maxSizeMB = maxMb ? maxMb : 5; // 5MB
            const maxByte = maxSizeMB * 1024 * 1024;
            const fileByte = file.size;

            if (fileByte > maxByte) {
                resultData.message = `${maxSizeMB}MB 이하 파일만 등록이 가능합니다.`;
                return resultData;
            }

            const formData = new FormData();
            formData.append('uploaded_file', file);
            formData.append('target', target);

            if (createFolderType) {
                formData.append(createFolderType, value);
            }

            const response = await API.fetchData('/file/upload', formData);

            if (response.result) {
                resultData.result = true;
                resultData.data = response;
            }

            return resultData;
        },

        async multiple(input, target, createFolderType, maxMb, value = 'Y') {
            const files = input.files;
            const results = [];

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const resultData = {result: false, originFileName: file.name};

                // 최대용량체크
                const maxSizeMB = maxMb ? maxMb : 5; // 5MB
                const maxByte = maxSizeMB * 1024 * 1024;
                const fileByte = file.size;

                if (fileByte > maxByte) {
                    resultData.message = `${maxSizeMB}MB 이하 파일만 등록이 가능합니다.`;
                    results.push(resultData);
                    continue;
                }

                const formData = new FormData();
                formData.append('uploaded_file', file);
                formData.append('target', target);

                if (createFolderType) {
                    formData.append(createFolderType, value);
                }

                const response = await API.fetchData('/file/upload', formData);

                if (response.result) {
                    resultData.result = true;
                    resultData.data = response;
                }

                results.push(resultData);
            }

            return results;
        },
    };
})();