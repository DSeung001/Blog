require('../bootstrap')

Vue.Component('chat-messages', require('../components/ChatMessages.vue'));
Vue.Component('chat-form', require('../components/ChatForm.vue'))

const app = new Vue({
    el : '#app',
    data: {
        messages : []
    },
    created(){
        this.fetchMessages();
    },
    methods:{
        fetchMessages(){
            axios.get('/messages').then(response =>{
               this.messages = response.data;
            });
        },
        addMessage(message){
            this.messages.push(message);
            axios.post('/messages',message).then(response =>{
                console.log(response.data);
            });
        }
    }
})
