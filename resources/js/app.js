import axios from "axios";
import "./bootstrap";

document.addEventListener("DOMContentLoaded", function () {
    approveApprovalButton()
    rejectApprovalButton();
    rejectBinagramButton();
    approveBinagramButton();
    getTriwulanParams();
    activateTriwulanButton();
    handleDropdown();
    setupDeleteSubIndikatorButton();
    setupEditSubIndikatorButton();
    setupAddSubIndikatorButton();
    setupDeleteIndikatorPenunjangButton();
    setupEditIndikatorPenunjangButton();
    setupAddIndikatorPenunjangButton();
    setupDeleteIndikatorButton();
    setupEditIndikatorButton();
    handleProfilePopUp();
    setupAddIndikatorButton();
    setupDeleteSasaranButton();
    setupEditSasaranButton();
    setupAddSasaranButton();
    setupDeleteTujuanButton();
    setupEditTujuanButton();
    setupAddTujuanButton();
    setupLogoutButtons();
    highlightActiveMenuItem();
    applyFiltersFromURL();
    setupDropdownLists();
    setupDeleteButtons();
    setupEditButtons();
    setupTableSearch();
});

function getTriwulanParams() {
    try {
        // Ambil parameter dari URL
        const urlParams = new URLSearchParams(window.location.search);
        const triwulanParam = urlParams.get("triwulan");

        // Cari elemen dropdown
        const selectElement = document.querySelector('select[name="triwulan_id"]');

        // Hentikan eksekusi jika elemen tidak ditemukan
        if (!selectElement) {
            console.warn('Dropdown triwulan_id tidak ditemukan di halaman ini');
            return;
        }

        // Pastikan elemen memiliki options sebelum melakukan iterasi
        if (selectElement && selectElement.options && selectElement.options.length > 0) {
            // Set nilai dropdown jika ada parameter
            if (triwulanParam) {
                Array.from(selectElement.options).forEach((option) => {
                    if (option.value === triwulanParam) {
                        option.selected = true;
                    }
                });
            }

            // Event listener untuk perubahan dropdown
            selectElement.addEventListener("change", function (e) {
                const currentParams = new URLSearchParams(window.location.search);
                currentParams.set('triwulan', this.value);
                const newUrl = window.location.pathname +
                    (currentParams.toString() ? '?' + currentParams.toString() : '');
                window.location.href = newUrl;
            });
        }
    } catch (error) {
        console.warn("Dropdown triwulan tidak tersedia di halaman ini:", error);
    }
}

// Tunggu hingga DOM selesai dimuat
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', getTriwulanParams);
} else {
    getTriwulanParams();
}


function setupLogoutButtons() {
    document.querySelectorAll(".logout-btn").forEach((btn) =>
        btn.addEventListener("click", function () {
            const logoutUrl = btn.getAttribute('data-url'); // Mengambil URL dari atribut data-url

            swal({
                title: "Apakah anda ingin keluar?",
                icon: "warning",
                buttons: {
                    confirm: {
                        text: "Iya",
                        value: true,
                        visible: true,
                        className: "swal-button--confirm",
                        closeModal: true,
                    },
                    cancel: {
                        text: "Tidak",
                        value: null,
                        visible: true,
                        className: "",
                        closeModal: true,
                    },
                },
                dangerMode: false,
            }).then((willLogout) => {
                if (willLogout) {
                    window.location.href = logoutUrl; // Arahkan ke URL logout
                }
            });
        })
    );
}

function highlightActiveMenuItem() {
    const links = document.querySelectorAll("a.menu-item");
    links.forEach((link) => {
        const menuItem = link.querySelector("div");
        if (menuItem) {
            if (window.location.pathname.includes(link.getAttribute("href"))) {
                menuItem.classList.add("bg-blue-50", "text-blue-600");
            } else {
                menuItem.classList.remove("bg-blue-50", "text-blue-600");
            }
        }
    });
}

function applyFiltersFromURL() {
    const params = new URLSearchParams(window.location.search);
    document
        .querySelectorAll("select.filter-select option")
        .forEach(
            (opt) =>
                opt.getAttribute("value") === params.get("filter") &&
                opt.setAttribute("selected", true)
        );
    document
        .querySelectorAll("select.sort-order option")
        .forEach(
            (sort) =>
                sort.getAttribute("value") === params.get("sort_order") &&
                sort.setAttribute("selected", true)
        );
}

function setupDropdownLists() {
    document.querySelectorAll(".parent .btn").forEach((parentBtn) => {
        parentBtn.addEventListener("click", function () {
            const childUl = this.parentNode.nextElementSibling;
            if (childUl && childUl.classList.contains("child")) {
                childUl.classList.contains("hidden")
                    ? expand(childUl, this)
                    : collapseAll(childUl, this);
            }
        });
    });
}

function collapseAll(element, parentBtn) {
    element.classList.add("hidden");
    parentBtn.classList.remove("fa-minus");
    parentBtn.classList.add("fa-plus");

    element.querySelectorAll(".child").forEach((child) => {
        child.classList.add("hidden");
        const childBtn = child.previousElementSibling.querySelector(".btn");
        if (childBtn) {
            childBtn.classList.remove("fa-minus");
            childBtn.classList.add("fa-plus");
        }
    });
}

function expand(element, parentBtn) {
    element.classList.remove("hidden");
    parentBtn.classList.remove("fa-plus");
    parentBtn.classList.add("fa-minus");
}

function setupAddTujuanButton() {
    document.querySelectorAll(".add-tujuan").forEach((btn) => {
        btn.addEventListener("click", function () {
            const iku = this.dataset.iku;
            const text = this.dataset.text;
            swal({
                text: "Tambahkan Tujuan di " + text,
                content: "input",
                buttons: {
                    cancel: true,
                    confirm: {
                        text: "Tambah",
                        closeModal: false,
                    },
                },
            }).then((value) => {
                if (value === null) {
                    return;
                }

                if (!value) {
                    swal({
                        icon: "error",
                        title: "Failed Added",
                        text: "Tujuan tidak boleh kosong",
                    });
                    return;
                }

                const data = {
                    tujuan: value,
                    iku: iku,
                };
                axios
                    .post("/adminbinagram/dashboard/store", data)
                    .then((response) => {
                        swal({
                            icon: "success",
                            title: "Successfully Added",
                            text: "Data tujuan berhasil dimasukkan",
                        }).then(() => {
                            window.location.href = "/adminbinagram/dashboard";
                        });
                    })
                    .catch((error) => {
                        swal({
                            icon: "error",
                            title: "Failed Added",
                            text: "Gagal memasukkan data tujuan",
                        });
                    });
            });
        });
    });
}

function setupEditTujuanButton() {
    document.querySelectorAll(".edit-tujuan").forEach((btn) =>
        btn.addEventListener("click", function () {
            const id = this.dataset.id;
            const currentTujuan = this.dataset.tujuan;

            swal({
                text: "Edit Tujuan",
                content: {
                    element: "input",
                    attributes: {
                        value: currentTujuan,
                    },
                },
                buttons: {
                    cancel: true,
                    confirm: {
                        text: "Update",
                        closeModal: false,
                    },
                },
            }).then((value) => {
                if (value === null) {
                    return;
                }

                if (!value) {
                    swal({
                        icon: "error",
                        title: "Failed Update",
                        text: "Tujuan tidak boleh kosong",
                    });
                    return;
                }
                if (value) {
                    const data = {
                        tujuan: value,
                    };
                    axios
                        .put(`/adminbinagram/dashboard/update/${id}`, data)
                        .then((response) => {
                            swal({
                                icon: "success",
                                title: "Successfully Update",
                                text: "Data tujuan berhasil diperbarui",
                            }).then(() => {
                                window.location.href =
                                    "/adminbinagram/dashboard";
                            });
                        })
                        .catch((error) => {
                            swal({
                                icon: "error",
                                title: "Failed Update",
                                text: "Gagal memperbarui data tujuan",
                            });
                        });
                }
            });
        })
    );
}

function setupDeleteTujuanButton() {
    document.querySelectorAll(".delete-tujuan").forEach((btn) => {
        btn.addEventListener("click", function () {
            const id = this.dataset.id;
            const tujuan = this.dataset.tujuan;

            swal({
                title: "Anda yakin ingin menghapus data ini?",
                text:
                    "[TUJUAN] " +
                    tujuan +
                    "\n\nPerhatian!! Data sasaran, indikator, indikator penunjang, dan sub indikator di tujuan ini juga akan terhapus!",
                icon: "warning",
                buttons: ["Cancel", "Hapus"],
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    axios
                        .delete(`/adminbinagram/dashboard/delete/${id}`)
                        .then((response) => {
                            swal({
                                icon: "success",
                                title: "Succesfully Deleted",
                                text: "Data tujuan berhasil dihapus",
                            }).then(() => {
                                window.location.reload();
                            });
                        })
                        .catch((error) => {
                            swal({
                                icon: "error",
                                title: "Failed Deleted",
                                text: "Gagal menghapus data tujuan",
                            });
                        });
                }
            });
        });
    });
}

function setupAddSasaranButton() {
    document.querySelectorAll(".add-sasaran").forEach((btn) => {
        btn.addEventListener("click", function () {
            const tujuanId = this.dataset.tujuanId;
            const text = this.dataset.text;
            swal({
                text: "Tambahkan Sasaran di " + text,
                content: "input",
                buttons: {
                    cancel: true,
                    confirm: {
                        text: "Tambah",
                        closeModal: false,
                    },
                },
            }).then((value) => {
                if (value === null) {
                    return;
                }

                if (!value) {
                    swal({
                        icon: "error",
                        title: "Failed Added",
                        text: "Sasaran tidak boleh kosong",
                    });
                    return;
                }

                const data = {
                    sasaran: value,
                    tujuan_id: tujuanId,
                };

                axios
                    .post("/adminbinagram/dashboard/store", data)
                    .then((response) => {
                        swal({
                            icon: "success",
                            title: "Successfully Added",
                            text: "Data sasaran berhasil dimasukkan",
                        }).then(() => {
                            window.location.href = "/adminbinagram/dashboard";
                        });
                    })
                    .catch((error) => {
                        swal({
                            icon: "error",
                            title: "Failed Added",
                            text: "Gagal memasukkan data sasaran",
                        });
                    });
            });
        });
    });
}

function setupEditSasaranButton() {
    document.querySelectorAll(".edit-sasaran").forEach((btn) => {
        btn.addEventListener("click", function () {
            const id = this.dataset.id;
            const currentSasaran = this.dataset.sasaran;

            swal({
                text: "Edit Sasaran",
                content: {
                    element: "input",
                    attributes: {
                        value: currentSasaran,
                    },
                },
                buttons: {
                    cancel: true,
                    confirm: {
                        text: "Update",
                        closeModal: false,
                    },
                },
            }).then((value) => {
                if (value === null) {
                    return;
                }

                if (!value) {
                    swal({
                        icon: "error",
                        title: "Failed Update",
                        text: "Sasaran tidak boleh kosong",
                    });
                    return;
                }
                if (value) {
                    const data = {
                        sasaran: value,
                    };
                    axios
                        .put(`/adminbinagram/dashboard/update/${id}`, data)
                        .then((response) => {
                            swal({
                                icon: "success",
                                title: "Successfully Update",
                                text: "Data sasaran berhasil diperbarui",
                            }).then(() => {
                                window.location.href =
                                    "/adminbinagram/dashboard";
                            });
                        })
                        .catch((error) => {
                            swal({
                                icon: "error",
                                title: "Failed Update",
                                text: "Gagal memperbarui data sasaran",
                            });
                        });
                }
            });
        });
    });
}

function setupDeleteSasaranButton() {
    document.querySelectorAll(".delete-sasaran").forEach((btn) => {
        btn.addEventListener("click", function () {
            const id = this.dataset.id;
            const sasaran = this.dataset.sasaran;

            swal({
                title: "Anda yakin ingin menghapus data ini?",
                text:
                    "[SASARAN] " +
                    sasaran +
                    "\n\nPerhatian!! Data indikator, indikator penunjang, dan sub indikator di sasaran ini juga akan terhapus!",
                icon: "warning",
                buttons: ["Cancel", "Hapus"],
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    axios
                        .delete(`/adminbinagram/dashboard/delete/${id}`, {
                            data: { is_sasaran: true },
                        })
                        .then((response) => {
                            swal({
                                icon: "success",
                                title: "Successfully Deleted",
                                text: "Data sasaran berhasil dihapus",
                            }).then(() => {
                                window.location.reload();
                            });
                        })
                        .catch((error) => {
                            swal({
                                icon: "error",
                                title: "Failed Deleted",
                                text: "Gagal menghapus data sasaran",
                            });
                        });
                }
            });
        });
    });
}

function setupAddIndikatorButton() {
    document.querySelectorAll(".add-indikator").forEach((btn) => {
        btn.addEventListener("click", function () {
            const sasaranId = this.dataset.sasaranId;
            const text = this.dataset.text;

            swal({
                text: "Tambahkan Indikator di " + text,
                content: {
                    element: "div",
                    attributes: {
                        innerHTML: `
                                <div style="display: flex; flex-direction: column; gap: 10px;">
                                    <div style="display: flex; flex-direction: column; align-items: start; gap: 5px">
                                        <label for="indikator">Indikator:</label>
                                        <input id="input1" class="swal-content__input" placeholder="Wajib diisi" style="flex-grow: 1;">
                                    </div>
                                    <div style="display: flex; flex-direction: column; align-items: start; gap: 5px">
                                        <label for="indikator_penunjang">Indikator Penunjang:</label>
                                        <input id="input2" class="swal-content__input" placeholder="Boleh kosong" style="flex-grow: 1;">
                                    </div>
                                    <div style="display: flex; flex-direction: column; align-items: start; gap: 5px">
                                        <label for="sub_indikator">Sub Indikator:</label>
                                        <input id="input3" class="swal-content__input" placeholder="Boleh kosong" style="flex-grow: 1;">
                                    </div>
                                    <div style="display: flex; flex-direction: column; align-items: start; gap: 5px">
                                        <label for="bidang">Bidang:</label>
                                        <select id="bidangSelect" class="swal-content__select" style="flex-grow: 1; width: 100%; border: 1px solid #ccc; padding: 6px 12px;">
                                            <option value="">pilih bidang (boleh kosong)</option>
                                            <option value="6">Fungsi IPDS</option>
                                            <option value="5">Fungsi Nerwilis</option>
                                            <option value="4">Fungsi Statistik Distribusi</option>
                                            <option value="3">Fungsi Statistik Produksi</option>
                                            <option value="2">Fungsi Statistik Sosial</option>
                                            <option value="1">Bagian Umum</option>
                                        </select>
                                    </div>
                                    <div style="display: flex; flex-direction: column; align-items: start; gap: 5px">
                                        <p>Jika terdapat data indikator penunjang atau sub indikator dan bidang pemilik sub indikator, mohon untuk langsung diinputkan</p>
                                    </div>
                                </div>
                            `,
                    },
                },
                buttons: {
                    cancel: true,
                    confirm: {
                        text: "Tambah",
                        closeModal: false,
                    },
                },
            }).then((value) => {
                if (value === null) {
                    return;
                }

                const input1 = document.getElementById("input1").value.trim();
                const input2 =
                    document.getElementById("input2").value.trim() || null;
                const input3 =
                    document.getElementById("input3").value.trim() || null;
                const bidangId =
                    document.getElementById("bidangSelect").value || null;

                if (!input1) {
                    swal({
                        icon: "error",
                        title: "Failed Added",
                        text: "Indikator tidak boleh kosong",
                    });
                    return;
                }

                if (bidangId && !input3) {
                    swal({
                        icon: "error",
                        title: "Failed Added",
                        text: "Jika bidang dipilih, Sub Indikator tidak boleh kosong",
                    });
                    return;
                }

                const data = {
                    indikator: input1,
                    indikator_penunjang: input2 === "" ? null : input2,
                    sub_indikator: input3 === "" ? null : input3,
                    sasaran_id: sasaranId,
                    bidang_id: bidangId === "" ? null : bidangId,
                };

                axios
                    .post("/adminbinagram/dashboard/store", data)
                    .then((response) => {
                        swal({
                            icon: "success",
                            title: "Successfully Added",
                            text: "Data berhasil dimasukkan",
                        }).then(() => {
                            window.location.href = "/adminbinagram/dashboard";
                        });
                    })
                    .catch((error) => {
                        swal({
                            icon: "error",
                            title: "Failed Added",
                            text: "Gagal memasukkan data",
                        });
                    });
            });
        });
    });
}

function setupEditIndikatorButton() {
    document.querySelectorAll(".edit-indikator").forEach((btn) => {
        btn.addEventListener("click", function () {
            const id = this.dataset.id;
            const currentIndikator = this.dataset.indikator;

            swal({
                text: "Edit Indikator",
                content: {
                    element: "input",
                    attributes: {
                        value: currentIndikator,
                    },
                },
                buttons: {
                    cancel: true,
                    confirm: {
                        text: "Update",
                        closeModal: false,
                    },
                },
            }).then((value) => {
                if (value === null) {
                    return;
                }

                if (!value) {
                    swal({
                        icon: "error",
                        title: "Failed Update",
                        text: "Indikator tidak boleh kosong",
                    });
                    return;
                }
                if (value) {
                    const data = {
                        indikator: value,
                    };
                    axios
                        .put(`/adminbinagram/dashboard/update/${id}`, data)
                        .then((response) => {
                            swal({
                                icon: "success",
                                title: "Successfully Update",
                                text: "Data indikator berhasil diperbarui",
                            }).then(() => {
                                window.location.href =
                                    "/adminbinagram/dashboard";
                            });
                        })
                        .catch((error) => {
                            swal({
                                icon: "error",
                                title: "Failed Update",
                                text: "Gagal memperbarui data indikator",
                            });
                        });
                }
            });
        });
    });
}

function setupDeleteIndikatorButton() {
    document.querySelectorAll(".delete-indikator").forEach((btn) => {
        btn.addEventListener("click", function () {
            const id = this.dataset.id;
            const indikator = this.dataset.indikator;

            swal({
                title: "Anda yakin ingin menghapus data ini?",
                text:
                    "[INDIKATOR] " +
                    indikator +
                    "\n\nPerhatian!! Data indikator penunjang dan sub indikator di indikator ini juga akan terhapus!",
                icon: "warning",
                buttons: ["Cancel", "Hapus"],
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    axios
                        .delete(`/adminbinagram/dashboard/delete/${id}`, {
                            data: { is_indikator: true },
                        })
                        .then((response) => {
                            swal({
                                icon: "success",
                                title: "Successfully Deleted",
                                text: "Data indikator berhasil dihapus",
                            }).then(() => {
                                window.location.reload();
                            });
                        })
                        .catch((error) => {
                            swal({
                                icon: "error",
                                title: "Failed Deleted",
                                text: "Gagal menghapus data indikator",
                            });
                        });
                }
            });
        });
    });
}

function setupAddIndikatorPenunjangButton() {
    document.querySelectorAll(".add-indikator-penunjang").forEach((btn) => {
        btn.addEventListener("click", function () {
            const indikatorId = this.dataset.indikatorId;
            const text = this.dataset.text;

            swal({
                text: "Tambahkan Indikator Penunjang di " + text,
                content: {
                    element: "div",
                    attributes: {
                        innerHTML: `
                                <div style="display: flex; flex-direction: column; gap: 10px;">
                                    <div style="display: flex; flex-direction: column; align-items: start; gap: 5px">
                                        <label for="indikator_penunjang">Indikator Penunjang:</label>
                                        <input id="input2" class="swal-content__input" placeholder="Boleh kosong" style="flex-grow: 1;">
                                    </div>
                                    <div style="display: flex; flex-direction: column; align-items: start; gap: 5px">
                                        <label for="sub_indikator">Sub Indikator:</label>
                                        <input id="input3" class="swal-content__input" placeholder="Boleh kosong" style="flex-grow: 1;">
                                    </div>
                                    <div style="display: flex; flex-direction: column; align-items: start; gap: 5px">
                                        <label for="bidang">Bidang:</label>
                                        <select id="bidangSelect" class="swal-content__select" style="flex-grow: 1; width: 100%; border: 1px solid #ccc; padding: 6px 12px;">
                                            <option value="">pilih bidang (boleh kosong)</option>
                                            <option value="6">Fungsi IPDS</option>
                                            <option value="5">Fungsi Nerwilis</option>
                                            <option value="4">Fungsi Statistik Distribusi</option>
                                            <option value="3">Fungsi Statistik Produksi</option>
                                            <option value="2">Fungsi Statistik Sosial</option>
                                            <option value="1">Bagian Umum</option>
                                        </select>
                                    </div>
                                    <div style="display: flex; flex-direction: column; align-items: start; gap: 5px">
                                        <p>Jika terdapat data sub indikator dan bidang pemiliki sub indikator, mohon untuk langsung diinputkan</p>
                                    </div>
                                </div>
                            `,
                    },
                },
                buttons: {
                    cancel: true,
                    confirm: {
                        text: "Tambah",
                        closeModal: false,
                    },
                },
            }).then((value) => {
                if (value === null) {
                    return;
                }

                const input2 =
                    document.getElementById("input2").value.trim() || null;
                const input3 =
                    document.getElementById("input3").value.trim() || null;
                const bidangId =
                    document.getElementById("bidangSelect").value || null;

                // if (!input2) {
                //     swal({
                //         icon: "error",
                //         title: "Failed Added",
                //         text: "Indikator Penunjang tidak boleh kosong",
                //     });
                //     return;
                // }

                if (bidangId && !input3) {
                    swal({
                        icon: "error",
                        title: "Failed Added",
                        text: "Jika bidang dipilih, Sub Indikator tidak boleh kosong",
                    });
                    return;
                }

                const data = {
                    indikator_penunjang: input2 === "" ? null : input2,
                    sub_indikator: input3 === "" ? null : input3,
                    indikator_id: indikatorId,
                    bidang_id: bidangId === "" ? null : bidangId,
                };

                axios
                    .post("/adminbinagram/dashboard/store", data)
                    .then((response) => {
                        swal({
                            icon: "success",
                            title: "Successfully Added",
                            text: "Data berhasil dimasukkan",
                        }).then(() => {
                            window.location.href = "/adminbinagram/dashboard";
                        });
                    })
                    .catch((error) => {
                        swal({
                            icon: "error",
                            title: "Failed Added",
                            text: "Gagal memasukkan data",
                        });
                    });
            });
        });
    });
}

function setupEditIndikatorPenunjangButton() {
    document.querySelectorAll(".edit-indikator-penunjang").forEach((btn) => {
        btn.addEventListener("click", function () {
            const id = this.dataset.id;
            const currentIndikatorPenunjang = this.dataset.indikator_penunjang;

            swal({
                text: "Edit Indikator Penunjang",
                content: {
                    element: "input",
                    attributes: {
                        value: currentIndikatorPenunjang,
                    },
                },
                buttons: {
                    cancel: true,
                    confirm: {
                        text: "Update",
                        closeModal: false,
                    },
                },
            }).then((value) => {
                if (value === null) {
                    return;
                }

                if (!value) {
                    swal({
                        icon: "error",
                        title: "Failed Update",
                        text: "Indikator penunjang tidak boleh kosong",
                    });
                    return;
                }
                if (value) {
                    const data = {
                        indikator_penunjang: value,
                    };
                    axios
                        .put(`/adminbinagram/dashboard/update/${id}`, data)
                        .then((response) => {
                            swal({
                                icon: "success",
                                title: "Successfully Update",
                                text: "Data indikator penunjang berhasil diperbarui",
                            }).then(() => {
                                window.location.href =
                                    "/adminbinagram/dashboard";
                            });
                        })
                        .catch((error) => {
                            swal({
                                icon: "error",
                                title: "Failed Update",
                                text: "Gagal memperbarui data indikator penunjang",
                            });
                        });
                }
            });
        });
    });
}

function setupDeleteIndikatorPenunjangButton() {
    document.querySelectorAll(".delete-indikator-penunjang").forEach((btn) => {
        btn.addEventListener("click", function () {
            const id = this.dataset.id;
            const indikator_penunjang = this.dataset.indikator_penunjang;

            swal({
                title: "Anda yakin ingin menghapus data ini?",
                text:
                    "[INDIKATOR PENUNJANG] " +
                    indikator_penunjang +
                    "\n\nPerhatian!! Data sub indikator di indikator penunjang ini juga akan terhapus!",
                icon: "warning",
                buttons: ["Cancel", "Hapus"],
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    axios
                        .delete(`/adminbinagram/dashboard/delete/${id}`, {
                            data: { is_indikator_penunjang: true },
                        })
                        .then((response) => {
                            swal({
                                icon: "success",
                                title: "Successfully Deleted",
                                text: "Data indikator penunjang berhasil dihapus",
                            }).then(() => {
                                window.location.reload();
                            });
                        })
                        .catch((error) => {
                            swal({
                                icon: "error",
                                title: "Failed Deleted",
                                text: "Gagal menghapus data indikator penunjang",
                            });
                        });
                }
            });
        });
    });
}

function setupAddSubIndikatorButton() {
    document.querySelectorAll(".add-sub-indikator").forEach((btn) => {
        btn.addEventListener("click", function () {
            const indikatorId = this.dataset.indikatorId;
            const indikatorPenunjangId = this.dataset.indikatorPenunjangId;
            const text = this.dataset.text;

            swal({
                text: "Tambahkan Indikator Penunjang di " + text,
                content: {
                    element: "div",
                    attributes: {
                        innerHTML: `
                            <div style="display: flex; flex-direction: column; gap: 10px;">
                            <div style="display: flex; flex-direction: column; align-items: start; gap: 5px">
                                <label for="sub_indikator">Sub Indikator:</label>
                                <input id="input3" class="swal-content__input" placeholder="wajib diisi" style="flex-grow: 1;">
                            </div>
                            <div style="display: flex; flex-direction: column; align-items: start; gap: 5px">
                                <label for="bidang">Bidang:</label>
                                <select id="bidangSelect" class="swal-content__select" style="flex-grow: 1; width: 100%; border: 1px solid #ccc; padding: 6px 12px;">
                                    <option value="">pilih bidang (boleh kosong)</option>
                                    <option value="6">Fungsi IPDS</option>
                                    <option value="5">Fungsi Nerwilis</option>
                                    <option value="4">Fungsi Statistik Distribusi</option>
                                    <option value="3">Fungsi Statistik Produksi</option>
                                    <option value="2">Fungsi Statistik Sosial</option>
                                    <option value="1">Bagian Umum</option>
                                </select>
                            </div>
                            <div style="display: flex; flex-direction: column; align-items: start; gap: 5px">
                                <p>Jika data sub indikator dimiliki salah satu bidang , mohon untuk pilih bidang</p>
                            </div>
                        </div>
                            `,
                    },
                },
                buttons: {
                    cancel: true,
                    confirm: {
                        text: "Tambah",
                        closeModal: false,
                    },
                },
            }).then((value) => {
                if (value === null) {
                    return;
                }

                const input3 = document.getElementById("input3").value.trim();
                const bidangId = document.getElementById("bidangSelect").value;

                if (!input3) {
                    swal({
                        icon: "error",
                        title: "Failed Added",
                        text: "Sub indikator tidak boleh kosong",
                    });
                    return;
                }

                const data = {
                    sub_indikator: input3,
                    indikator_id: indikatorId ? indikatorId : null,
                    indikator_penunjang_id: indikatorPenunjangId
                        ? indikatorPenunjangId
                        : null,
                    bidang_id: bidangId,
                };

                axios
                    .post("/adminbinagram/dashboard/store", data)
                    .then((response) => {
                        swal({
                            icon: "success",
                            title: "Successfully Added",
                            text: "Data berhasil dimasukkan",
                        }).then(() => {
                            window.location.href = "/adminbinagram/dashboard";
                        });
                    })
                    .catch((error) => {
                        swal({
                            icon: "error",
                            title: "Failed Added",
                            text: "Gagal memasukkan data",
                        });
                    });
            });
        });
    });
}

function setupEditSubIndikatorButton() {
    document.querySelectorAll(".edit-sub-indikator").forEach((btn) => {
        btn.addEventListener("click", function () {
            const id = this.dataset.id;
            const currentSubIndikator = this.dataset.sub_indikator;
            const currentBidangId = this.dataset.bidang_id || "";

            swal({
                text: "Edit Sub Indikator",
                content: {
                    element: "div",
                    attributes: {
                        innerHTML: `
                                <div style="display: flex; flex-direction: column; gap: 10px;">
                                    <div style="display: flex; flex-direction: column; align-items: start; gap: 5px">
                                        <label for="sub_indikator">Sub Indikator:</label>
                                        <input id="subIndikatorInput" class="swal-content__input" value="${currentSubIndikator}" placeholder="Wajib diisi" style="flex-grow: 1;">
                                    </div>
                                    <div style="display: flex; flex-direction: column; align-items: start; gap: 5px">
                                        <label for="bidang">Bidang:</label>
                                        <select id="bidangSelect" class="swal-content__select" style="flex-grow: 1; width: 100%; border: 1px solid #ccc; padding: 6px 12px;">
                                            <option value="">pilih bidang (boleh kosong)</option>
                                            <option value="6" ${currentBidangId === "6"
                                ? "selected"
                                : ""
                            }>Fungsi IPDS</option>
                                            <option value="5" ${currentBidangId === "5"
                                ? "selected"
                                : ""
                            }>Fungsi Nerwilis</option>
                                            <option value="4" ${currentBidangId === "4"
                                ? "selected"
                                : ""
                            }>Fungsi Statistik Distribusi</option>
                                            <option value="3" ${currentBidangId === "3"
                                ? "selected"
                                : ""
                            }>Fungsi Statistik Produksi</option>
                                            <option value="2" ${currentBidangId === "2"
                                ? "selected"
                                : ""
                            }>Fungsi Statistik Sosial</option>
                                            <option value="1" ${currentBidangId === "1"
                                ? "selected"
                                : ""
                            }>Bagian Umum</option>
                                        </select>
                                    </div>
                                </div>
                            `,
                    },
                },
                buttons: {
                    cancel: true,
                    confirm: {
                        text: "Update",
                        closeModal: false,
                    },
                },
            }).then((value) => {
                if (value === null) {
                    return;
                }

                const subIndikator = document
                    .getElementById("subIndikatorInput")
                    .value.trim();
                const bidangId =
                    document.getElementById("bidangSelect").value || null;

                if (!subIndikator) {
                    swal({
                        icon: "error",
                        title: "Failed Update",
                        text: "Sub indikator tidak boleh kosong",
                    });
                    return;
                }

                const data = {
                    sub_indikator: subIndikator,
                    bidang_id: bidangId === "" ? null : bidangId,
                };

                axios
                    .put(`/adminbinagram/dashboard/update/${id}`, data)
                    .then((response) => {
                        swal({
                            icon: "success",
                            title: "Successfully Update",
                            text: "Data sub indikator berhasil diperbarui",
                        }).then(() => {
                            window.location.href = "/adminbinagram/dashboard";
                        });
                    })
                    .catch((error) => {
                        swal({
                            icon: "error",
                            title: "Failed Update",
                            text: "Gagal memperbarui data sub indikator",
                        });
                    });
            });
        });
    });
}

function setupDeleteSubIndikatorButton() {
    document.querySelectorAll(".delete-sub-indikator").forEach((btn) => {
        btn.addEventListener("click", function () {
            const id = this.dataset.id;
            const sub_indikator = this.dataset.sub_indikator;

            swal({
                title: "Anda yakin ingin menghapus data ini?",
                text: "[SUB INDIKATOR] " + sub_indikator,
                icon: "warning",
                buttons: ["Cancel", "Hapus"],
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    axios
                        .delete(`/adminbinagram/dashboard/delete/${id}`, {
                            data: { is_sub_indikator: true },
                        })
                        .then((response) => {
                            swal({
                                icon: "success",
                                title: "Successfully Deleted",
                                text: "Data sub indikator berhasil dihapus",
                            }).then(() => {
                                window.location.reload();
                            });
                        })
                        .catch((error) => {
                            swal({
                                icon: "error",
                                title: "Failed Deleted",
                                text: "Gagal menghapus data sub indikator",
                            });
                        });
                }
            });
        });
    });
}

function setupDeleteButtons() {
    document.querySelectorAll(".btn-delete").forEach((btn) =>
        btn.addEventListener("click", function () {
            const { nip, name, id } = this.dataset;
            swal({
                title: "Apakah anda ingin menghapus user ini?",
                text: `Nama: ${name}\nNIP: ${nip}`,
                icon: "warning",
                buttons: {
                    confirm: {
                        text: "Hapus",
                        value: true,
                        visible: true,
                        className: "swal-button--confirm",
                        closeModal: true,
                    },
                    cancel: {
                        text: "Tidak",
                        value: null,
                        visible: true,
                        className: "",
                        closeModal: true,
                    },
                },
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    axios.delete(`/adminsistem/dashboard/${id}`).then(() => {
                        swal({
                            icon: "success",
                            title: "User Delete Successfully",
                            text: "Akun berhasil dihapus",
                        }).then(() => {
                            window.location.reload();
                        });
                    });
                }
            });
        })
    );
}

function setupEditButtons() {
    document.querySelectorAll(".btn-update").forEach((icon) =>
        icon.addEventListener("click", function () {
            const userId = this.dataset.id;
            let path = window.location.pathname;

            if (path.includes("/adminsistem")) {
                window.location.href = `/adminsistem/edit-user/${userId}`;
            } else if (path.includes("/adminbinagram")) {
                window.location.href = `/adminbinagram/edit-user/${userId}`;
            } else if (path.includes("/pimpinan")) {
                window.location.href = `/pimpinan/edit-user/${userId}`;
            } else if (path.includes("/adminapproval")) {
                window.location.href = `/adminapproval/edit-user/${userId}`;
            } else if (path.includes("/operator")) {
                window.location.href = `/operator/edit-user/${userId}`;
            }
        })
    );
}

function setupTableSearch() {
    const searchInput = document.getElementById("table-search");

    if (!searchInput) {
        console.warn("Element #table-search not found. Skipping search setup.");
        return; // Hentikan fungsi jika elemen tidak ada
    }

    searchInput.addEventListener("input", function (event) {
        const searchQuery = event.target.value;
        const url = new URL(window.location);
        url.searchParams.set("search", searchQuery);
        window.history.pushState({}, "", url);
    });
}

function handleProfilePopUp() {
    const profileBtn = document.querySelector(".profile-btn");
    const profileContainer = document.getElementById("profile-container");

    profileBtn.addEventListener("click", (event) => {
        event.stopPropagation(); // Prevent the click from bubbling up to the document
        profileContainer.classList.toggle("hidden");
    });

    document.addEventListener("click", (event) => {
        if (
            !profileContainer.classList.contains("hidden") &&
            !profileContainer.contains(event.target) &&
            !profileBtn.contains(event.target)
        ) {
            profileContainer.classList.add("hidden");
        }
    });
}

function handleDropdown() {
    const dropdownParents = document.querySelectorAll(".dropdown-parent");

    dropdownParents.forEach((parent) => {
        const button = parent.querySelector(".dropdown-button");
        const dropdown = parent.querySelector(".dropdown-child");
        const icon = button.querySelector(".dropdown-icon");
        const links = parent.querySelectorAll("a.menu-item");

        const checkAndCloseDropdown = () => {
            const currentURL = window.location.pathname;
            let isMatch = false;

            links.forEach((link) => {
                if (link.getAttribute("href") === currentURL) {
                    isMatch = true;
                }
            });

            if (isMatch) {
                dropdown.classList.add("open");
                icon.classList.add("open");
                dropdown.style.maxHeight = dropdown.scrollHeight + 20 + "px";
            }
        };

        button.addEventListener("click", () => {
            const isOpen = dropdown.classList.toggle("open");
            icon.classList.toggle("open", isOpen);
            dropdown.style.maxHeight = isOpen
                ? dropdown.scrollHeight + 20 + "px"
                : "0px";
        });

        // Check and close dropdown on page load
        checkAndCloseDropdown();
    });
}

function activateTriwulanButton() {
    document.querySelectorAll(".activate-triwulan").forEach((btn) => {
        btn.addEventListener("click", function () {
            const id = this.dataset.id;
            const currentTriwulan = this.dataset.triwulan;
            const status = this.dataset.status;

            let swalConfig;

            if (status === "close") {
                swalConfig = {
                    text: "Apakah anda ingin membuka " + currentTriwulan + "?",
                    icon: "warning",
                    buttons: {
                        cancel: true,
                        confirm: {
                            text: "Buka",
                            closeModal: true,
                        },
                    },
                };
            } else {
                swalConfig = {
                    text: "Apakah anda ingin menutup " + currentTriwulan + "?",
                    icon: "warning",
                    buttons: {
                        cancel: true,
                        confirm: {
                            text: "Tutup",
                            closeModal: true,
                        },
                    },
                };
            }

            swal(swalConfig).then((value) => {
                if (value) {
                    axios.put(`/adminbinagram/dashboard/actived-triwulan/${id}`)
                        .then((response) => {
                            if (status === "close") {
                                swal({
                                    icon: "success",
                                    title: "Successfully Opened",
                                    text: currentTriwulan + " berhasil dibuka",
                                }).then(() => {
                                    window.location.href = "/adminbinagram/dashboard";
                                });
                            } else {
                                swal({
                                    icon: "success",
                                    title: "Successfully Closed",
                                    text: currentTriwulan + " berhasil ditutup",
                                }).then(() => {
                                    window.location.href = "/adminbinagram/dashboard";
                                });
                            }
                        })
                        .catch((error) => {
                            swal({
                                icon: "error",
                                title: "Failed Action",
                                text: "Gagal membuka atau menutup triwulan",
                            });
                        });
                }
            });
        });
    });
}

function approveBinagramButton() {
    document.querySelectorAll(".approve-binagram").forEach((btn) => {
        btn.addEventListener("click", function () {
            const id = this.dataset.id;
            const text = this.dataset.text;

            swal({
                title: "Setujui dokumen ini?",
                text: text,
                icon: "warning",
                buttons: ["Cancel", "Setuju"]
            }).then((value) => {
                if (value) {
                    axios
                        .put(`/adminbinagram/approve-master-data/${id}`)
                        .then((response) => {
                            swal({
                                icon: "success",
                                title: "Successfully Approve",
                                text: "Data disetujui",
                            }).then(() => {
                                window.location.href =
                                    "/adminbinagram/pending-master-data";
                            });
                        })
                        .catch((error) => {
                            console.log(error)
                            swal({
                                icon: "error",
                                title: "Failed Approve",
                                text: "Gagal menyetujui data",
                            });
                        });
                }
            });
        });
    });
}

function rejectBinagramButton() {
    document.querySelectorAll(".reject-binagram").forEach((btn) => {
        btn.addEventListener("click", function () {
            const id = this.dataset.id;
            const text = this.dataset.text;

            swal({
                text: "Masukkan Komentar",
                content: {
                    element: "input",
                    attributes: {
                        value: "",
                        placeholder: "Komentar tidak boleh kosong!"
                    },
                },
                buttons: {
                    cancel: true,
                    confirm: {
                        text: "Tolak",
                        closeModal: false,
                    },
                },
                dangerMode: true
            }).then((value) => {
                if (value === null) {
                    return;
                }

                if (value === "") {
                    swal({
                        icon: "error",
                        title: "Failed Reject",
                        text: "Komentar tidak boleh kosong",
                    });
                    return;
                }

                if (value) {
                    const data = {
                        reject_comment: value,
                    };
                    axios
                        .put(`/adminbinagram/reject-master-data/${id}`, data)
                        .then((response) => {
                            swal({
                                icon: "success",
                                title: "Successfully Reject",
                                text: "Data ditolak",
                            }).then(() => {
                                window.location.href =
                                    "/adminbinagram/pending-master-data";
                            });
                        })
                        .catch((error) => {
                            swal({
                                icon: "error",
                                title: "Failed Reject",
                                text: "Gagal menolak data",
                            });
                        });
                }
            });
        });
    });
}

function approveApprovalButton() {
    document.querySelectorAll(".approve-approval").forEach((btn) => {
        btn.addEventListener("click", function () {
            const id = this.dataset.id;
            const text = this.dataset.text;
            const triwulan = this.dataset.triwulan;

            swal({
                title: "Setujui dokumen ini?",
                text: text,
                icon: "warning",
                buttons: ["Cancel", "Setuju"]
            }).then((value) => {
                if (value) {
                    axios
                        .put(`/adminapproval/approve-master-data/${id}?triwulan=${triwulan}`)
                        .then((response) => {
                            swal({
                                icon: "success",
                                title: "Successfully Approve",
                                text: "Data disetujui",
                            }).then(() => {
                                window.location.href =
                                    "/adminapproval/dashboard";
                            });
                        })
                        .catch((error) => {
                            console.log(error)
                            swal({
                                icon: "error",
                                title: "Failed Approve",
                                text: "Gagal menyetujui data",
                            });
                        });
                }
            });
        });
    });
}

function rejectApprovalButton() {
    document.querySelectorAll(".reject-approval").forEach((btn) => {
        btn.addEventListener("click", function () {
            const id = this.dataset.id;
            const text = this.dataset.text;
            const triwulan = this.dataset.triwulan;

            swal({
                text: "Masukkan Komentar",
                content: {
                    element: "input",
                    attributes: {
                        value: "",
                        placeholder: "Komentar tidak boleh kosong!"
                    },
                },
                buttons: {
                    cancel: true,
                    confirm: {
                        text: "Tolak",
                        closeModal: false,
                    },
                },
                dangerMode: true
            }).then((value) => {
                if (value === null) {
                    return;
                }

                if (value === "") {
                    swal({
                        icon: "error",
                        title: "Failed Reject",
                        text: "Komentar tidak boleh kosong",
                    });
                    return;
                }

                if (value) {
                    const data = {
                        reject_comment: value,
                    };
                    axios
                        .put(`/adminapproval/reject-master-data/${id}?triwulan=${triwulan}`, data)
                        .then((response) => {
                            swal({
                                icon: "success",
                                title: "Successfully Reject",
                                text: "Data ditolak",
                            }).then(() => {
                                window.location.href =
                                    "/adminapproval/dashboard";
                            });
                        })
                        .catch((error) => {
                            swal({
                                icon: "error",
                                title: "Failed Reject",
                                text: "Gagal menolak data",
                            });
                        });
                }
            });
        });
    });
}
