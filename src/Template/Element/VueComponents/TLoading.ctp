<script type="text/x-template" id="t-loading-component">
    <div align="center" class="my-4" v-if="loading">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</script>

<script>
const TLoading = {
    template: '#t-loading-component',
    props: {
        loading: {
            type: Boolean,
            required: true,
            default: false
        }
    }
}
</script>
