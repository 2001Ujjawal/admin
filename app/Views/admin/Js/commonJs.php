<?php

?>
<script>
    console.log("hello from commonjs");
    /** 
        function HandleAjaxRequest(url, data, method) {
            console.log("================== HandleAjaxRequest");

            $.ajax({
                url: url,
                data: data,
                type: method,
                dataType: "json",
                success: function(response) {
                    if (response.status === true) {
                        if (response.statusCode === 200) {
                            console.log("Request successful:", response.message);
                            return returnResponseValue(response.status, response.message, response.data);
                        } else if (response.statusCode === 201) {
                            console.log("Resource successfully created:", response.message);
                            return returnResponseValue(response.status, response.message, response.data);
                        } else {
                            return returnResponseValue(response.status, response.message, response.data);
                            console.log("Unexpected success response:", response);
                        }
                    } else {
                        console.log("Response not successful:", response);
                        return returnResponseValue(response.status, response.message, response.data);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.error("Error status:", xhr.status);
                    console.error("Error thrown:", thrownError);

                    if (xhr.status === 401) {
                        window.location.href = '<?= base_url("/login"); ?>';
                    } else if (xhr.status === 403) {
                        console.error("Access forbidden: You don't have permission to perform this action.");
                    } else if (xhr.status === 500) {
                        console.error("Internal server error occurred.");
                    } else {
                        console.error("An unexpected error occurred:", xhr.responseText);
                    }
                }
            });
        }




        function returnResponseValue(status, message, data) {
            return {
                "response": {
                    "status": status ?? false,
                    "message": message,
                    "data": data ?? null,
                }
            }

        }
        */
</script>