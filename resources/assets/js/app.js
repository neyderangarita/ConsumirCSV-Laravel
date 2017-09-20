new Vue({
	el: '#componente',
	created: function() {
		this.getListadoArtistas();
	},
	data: {
		keeps: [],
		newKeep: '',
		errors: []
	},
	methods: {
		getListadoArtistas: function() {
			var urlArtistas = 'consumir';
			axios.get(urlArtistas).then(response => {

				//filtar datos repetidos
				var counts = _.countBy(response.data,'Artist');
				var data = _.map(counts, function(value, key){
				    return {
				        artista: key,
				        cantidad: value
				    };
				});

				var artistas = [];
				for (var i in data) {
					if (data[i].cantidad > 1){
						artistas.push(data[i]);
					}
				}

				var retorno = _.sortBy(artistas, 'cantidad').reverse();
				this.keeps = retorno;

			});
		}
	}

});

