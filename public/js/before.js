const getGlobalToast = () => new bootstrap.Toast(document.getElementById("globalToast"));

const getGlobalSuccessToast = () => new bootstrap.Toast(document.getElementById("globalSuccessToast"));

const getGlobalDangerToast = () => new bootstrap.Toast(document.getElementById("globalDangerToast"));

const showGlobalToast = (message, header = "Some error has happened") => {
    showToast("globalToast", message, header);
}

const showGlobalSuccessToast = (message, header = "Success") => {
    showToast("globalSuccessToast", message, header);
}

const showGlobalDangerToast = (message, header = "Some error has happened") => {
    showToast("globalDangerToast", message, header);
}

const showToast = (id, message, header = "Alert") => {
    const toast = $("#" + id);
    toast.find("[name='message']").text(message);
    toast.find("[name='header']").text(header);
    new bootstrap.Toast(document.getElementById(id)).show();
}

function showModal(id, dialog) {
    const modal = $("#" + id);
    if (!modal) {
        return;
    }
    modal.empty().append(dialog);
    const myModalEl = document.getElementById(id);
    const m = new bootstrap.Modal(myModalEl);
    m.show();
}

function showGlobalModal(header, body, footer = null, type = "default") {
    let headerStyle = "bg-light";
    if (type === "success") {
        headerStyle = "bg-success text-white";
    } else if (type === "danger") {
        headerStyle = "bg-danger text-white";
    } else if (type === "warning") {
        headerStyle = "bg-warning";
    } else if (type === "primary") {
        headerStyle = "bg-primary text-white";
    }
    const f = footer ? footer : `<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button> `
    showModal("globalModal",
        `<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header ${headerStyle}">
                    <h5 class="modal-title" id="exampleModalLabel">${header}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ${body}
                </div>
                <div class="modal-footer">
                    ${f}
                </div>
            </div>
        </div>`
    );
}

function showImagePreview(imageUrl) {
    showGlobalModal("Image Preview", `<img class="img-fluid" src=${imageUrl} alt="Broken image">`);
}