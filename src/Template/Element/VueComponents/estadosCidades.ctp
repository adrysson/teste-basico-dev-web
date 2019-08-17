<script type="text/x-template" id="estados-cidades">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <div align="center" class="my-4" v-if="loadingEstados">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <div v-if="!isEmpty(estados) && !loadingEstados" class="input select">
                    <label for="estado-id">Estado</label>
                    <select v-model="form.estado_id" name="estado_id" id="estado-id" class="form-control" @change="getCidades()">
                        <option v-for="estado in estados" :value="estado.id_estado">{{estado.nom_estado}}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div align="center" class="my-4" v-if="loadingCidades">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <div v-if="!isEmpty(cidades) && !loadingCidades" class="input select">
                    <label for="cidade-id">Cidade</label>
                    <select v-model="form.cidade_id" name="cidade_id" id="cidade-id" class="form-control">
                        <option v-for="cidade in cidades" :value="cidade.id_cidade">{{cidade.nom_cidade}}</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</script>

<script>
const estadosCidades = {
    template: "#estados-cidades",
    data: function() {
        return {
            form: {
                estado_id: 1,
                cidade_id: null
            },
            estados: [],
            cidades: [],
            loadingEstados: false,
            loadingCidades: false
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
                    vm.getCidades()
                },
                complete: function() {
                    vm.loadingEstados = false
                },
            })
        },
        getCidades: function() {
            const vm = this
            $.ajax({
                url: 'estados/' + this.form.estado_id + '/cidades',
                headers: {
                    'Accept': 'application/json'
                },
                beforeSend: function() {
                    vm.loadingCidades = true
                },
                success: function(response) {
                    vm.cidades = response.cidades
                    vm.form.cidade_id = vm.cidades[0].id_cidade
                },
                complete: function() {
                    vm.loadingCidades = false
                },
            })
        }
    }
}
</script>
