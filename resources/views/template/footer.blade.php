
<script>
    $(document).ready(function() {
        var sessionData = <?php echo json_encode(session()->all()); ?>;
        if (sessionData.success) {
            new PNotify({
                title: 'Success',
                text: sessionData.success,
                addclass: 'bg-success border-success'
            });
        }
        if (sessionData.error) {
            new PNotify({
                title: 'Error !',
                text: sessionData.error,
                addclass: 'bg-danger border-danger'
            });
        }
    });
</script>


