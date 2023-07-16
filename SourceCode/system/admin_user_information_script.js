$(document).ready(function () {
    // Add User modal
    $("#addBtn").click(function () {
        $("#addModal").css("display", "block");
    });

    $(".close").click(function () {
        $(".modal").css("display", "none");
    });

    // Edit User modal
    $(".editBtn").click(function () {
        var id = $(this).data("id");
        var name = $(this).data("name");
        var email = $(this).data("email");

        $("#editId").val(id);
        $("#editName").val(name);
        $("#editEmail").val(email);

        $("#editModal").css("display", "block");
    });

    // Delete User modal
    $(".deleteBtn").click(function () {
        var id = $(this).data("id");

        $("#deleteId").val(id);

        $("#deleteModal").css("display", "block");
    });
});
