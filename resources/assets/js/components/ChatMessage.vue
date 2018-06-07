<template>
<div>
    <div class="send_row_2">
        <textarea class="send_row_message" id="btn-input" placeholder="Write your message" name="message" v-model="message" @keyup.enter="store()"></textarea>
    </div>
    <div class="send_row_3">
        <button class="btn btn-primary" id="btn-chat" type="submit" @click.prevent="store()">Send</button>
        <button type="button" class="btn btn-outline-secondary send_row_button2">Attach document</button>
    </div>

    <div class="send_row_4" v-for="conversation in conversations">
        <p class="send_row_p">
            May 26, 2018, 5:38 p.m.
            <br>
            <strong>{{ conversation.user.name }}</strong>:
            <br>{{ conversation.message }}
        </p>
    </div>
</div>
</template>
<script>
//   export default {
//      data() {
//             return {
//                 conversations: [],
//                 message: '',
//                 groupId:''
//             }
//         },

//         mounted() {
//             this.listenForNewMessage();

//             Bus.$on('groupCreated', (group) => {
//                 this.groupId = group;
//             });
//         },

//         methods: {
//             store() {
//                 axios.post('/conversations', {message: this.message, group_id: this.groupId})
//                 .then((response) => {
//                     this.message = '';
//                     this.conversations.push(response.data);
//                 });
//             },

//             listenForNewMessage() {
//                 Echo.private('groups.' + this.groupId)
//                     .listen('NewMessage', (e) => {
//                         // console.log(e);
//                         this.conversations.push(e);
//                     });
//             }
//         }
//   };
</script>
