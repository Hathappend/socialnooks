document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll("[data-upload-container]").forEach((container) => {
        const uploadPhotoBtn = container.querySelector(".uploadPhoto");
        const fileInput = container.querySelector(".fileInput");
        const fileListContainer = container.querySelector(".fileList");
        const uploadText = container.querySelector(".uploadText");

        if (uploadPhotoBtn && fileInput) {
            uploadPhotoBtn.addEventListener("click", function () {
                fileInput.click();
            });

            fileInput.addEventListener("change", function () {
                fileListContainer.innerHTML = "";

                const files = fileInput.files;

                if (files.length > 0) {
                    Array.from(files).forEach((file, index) => {
                        const fileItem = document.createElement("div");
                        fileItem.className = "file-item";

                        const fileName = document.createElement("span");
                        fileName.textContent = file.name;

                        const removeBtn = document.createElement("button");
                        removeBtn.textContent = "Remove";
                        removeBtn.className = "remove-btn";
                        removeBtn.addEventListener("click", function () {
                            removeFile(fileInput, index);
                        });

                        fileItem.appendChild(fileName);
                        fileItem.appendChild(removeBtn);
                        fileListContainer.appendChild(fileItem);
                    });
                } else {
                    uploadText.textContent = "Click here to upload (.jpg .png .jpeg)";
                }
            });
        }
    });

    function removeFile(input, index) {
        const dataTransfer = new DataTransfer();

        Array.from(input.files).forEach((file, i) => {
            if (i !== index) {
                dataTransfer.items.add(file);
            }
        });

        input.files = dataTransfer.files;

        const event = new Event('change');
        input.dispatchEvent(event);
    }
});
