const app = new Vue({
    el: '#app',
    components: {
        TLoading
    },
    data: function() {
        return {
            form: {
                nome: '',
                email: '',
                celular: '',
                estado_id: 1,
                cidade_id: null
            },
            errors: {},
            estados: [],
            cidades: [],
            loadingEstados: false,
            loadingCidades: false,
            loadingForm: false
        }
    },
    mounted: function() {
        this.getEstados()
        $(this.$refs.celular).mask('(00) 00000-0000');
    },
    methods: {
        submit: function() {
            const vm = this
            $.ajax({
                url: 'pessoas',
                type: 'POST',
                data: this.form,
                headers: {
                    'Accept': 'application/json'
                },
                beforeSend: function() {
                    vm.loadingForm = true
                },
                success: function(response) {
                    console.log(response)
                    // vm.estados = response.estados
                    // vm.getCidades()
                },
                error: function(xhr) {
                    console.log(xhr)
                },
                complete: function() {
                    vm.loadingEstados = false
                },
            })
        },
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
})
