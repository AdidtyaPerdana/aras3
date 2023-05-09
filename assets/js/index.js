// Dropdown data master sidebar
function dropdown() {
  document.querySelector("#submenu").classList.toggle("hidden");
  document.querySelector("#arrow").classList.toggle("rotate-180");
}

// Modal button karyawan
const modalAddKaryawan = document.querySelector(".modal-add-karyawan");

// Toogle modal karyawan
function toggleModalAddKaryawan() {
  modalAddKaryawan.classList.toggle("hidden");
}

function closeModalEditKaryawan() {
  document.querySelector(".modal-edit-karyawan").classList.toggle("hidden");
}

function closeModalEditKriteria() {
  document.querySelector(".modal-edit-kriteria").classList.toggle("hidden");
}

//Confirmation delete modal karyawan
$(".confirmation-delete").on("click", function () {
  var getLink = $(this).attr("href");
  Swal.fire({
    title: "Yakin hapus data?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "rgb(220 38 38)",
    confirmButtonText: "Ya",
    cancelButtonColor: "#62CDFF",
    cancelButtonText: "Batal",
  }).then((result) => {
    //jika klik ya maka arahkan ke proses.php
    if (result.isConfirmed) {
      window.location.href = getLink;
    }
  });
  return false;
});

//Modal edit karyawan
$(".btn-edit-karyawan").click(function () {
  document.querySelector(".modal-edit-karyawan").classList.toggle("hidden");
  var id = $(this).data("id");
  $.ajax({
    type: "post",
    url: "component/modal_edit_karyawan.php", //Here you will fetch records
    data: "id_karyawan=" + id, //Pass $id
    success: function (data) {
      $(".form-edit").html(data); //Show fetched data from database
    },
  });
});

//Modal edit kriteria
$(".btn-edit-kriteria").click(function () {
  console.log("tes");
  document.querySelector(".modal-edit-kriteria").classList.toggle("hidden");
  var id = $(this).data("id");
  $.ajax({
    type: "post",
    url: "component/modal_edit_kriteria.php", //Here you will fetch records
    data: "id_kriteria=" + id, //Pass $id
    success: function (data) {
      $(".form-edit").html(data); //Show fetched data from database
    },
  });
});
