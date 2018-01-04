/**
 * Created by mic on 1/3/18.
 */



 new Vue({
     delimiters: ['{!', '!}'],
     el: "#app",
     data: {
         players: []
 },
     created: function() {
         var that = this;
         axios.get('http://xolos.com.mx/api/v1/deportivos/LIGA/torneo/actual.json')
             .then(function (response) {
                 that.players = response.data.torneo
                 console.log(response.data);
             })
             .catch(function (error) {
                 console.log(error);
             });
     }
 })






//
// new Vue({
//     el: "#app",
//     delimiters: ['{!', '!}'],
//     data() {
//         return {
//             players: []
//         }
//     },
//     methods: {
//         readAPI(){
//             axios.get('https://xolos.com.mx/api/v1/deportivos/1/jugadores/categoria.json')
//                 .then(response => {
//                 this.players = response.data.post
//             console.log(response)
//         }).catch(e => {
//                 console.log(e)
//         })
//         }
//     },
//     created(){
//         this.readAPI()
//     }
// })