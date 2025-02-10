$(document).ready(function () {
    $("#search").on("keyup", function () {
        let query = $(this).val();
        if (query.length > 1) {
            $.ajax({
                url: "search.php",
                method: "POST",
                data: { query: query },
                success: function (data) {
                    $("#suggestions").html(data);
                }
            });
        } else {
            $("#suggestions").html("");
        }
    });

    $(document).on("click", ".suggestion", function () {
        $("#search").val($(this).text());
        $("#suggestions").html("");
    });
});
