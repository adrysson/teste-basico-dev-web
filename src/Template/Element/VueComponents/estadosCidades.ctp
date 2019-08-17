<script type="text/x-template" id="estados-cidades">
    <div class="col-md-6">
        <div align="center" class="my-4" v-if="this.loadingEstados">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <div v-if="!isEmpty(estados)" class="input select">
            <label for="estado-id">Estado</label>
            <select name="estado_id" id="estado-id" class="form-control">
                <option v-for="estado in estados" :value="estado.id_estado">{{estado.nom_estado}}</option>
            </select>
        </div>
    </div>
</script>

<script>
const estadosCidades = {
    template: "#estados-cidades",
    data: function() {
        return {
            estados: [],
            cidades: [],
            loadingEstados: false
        }
    },
    mounted: function() {
        this.getEstados()
    },
    methods: {
        isEmpty: function(object) {
            return $.isEmptyObject(object)
        },
        getEstados: function() {
            const vm = this
            $.ajax({
                url: 'estados',
                headers: {
                    'Accept': 'application/json'
                },
                beforeSend: function() {
                    vm.loadingEstados = true
                },
                success: function(response) {
                    vm.estados = response.estados
                },
                complete: function() {
                    vm.loadingEstados = false
                },
            })
        }
    }
}
</script>
