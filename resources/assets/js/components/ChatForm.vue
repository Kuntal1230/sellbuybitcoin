<template>
    <div>
          <div class="send_row_2">
          <textarea class="send_row_message" id="btn-input" placeholder="Write your message" name="message" v-model="newMessage" @keyup.enter="sendMessage"></textarea>
          </div>
          <div class="send_row_3">
              <button class="btn btn-primary" id="btn-chat" type="submit" @click="sendMessage">Send</button>
              <button type="button" class="btn btn-outline-secondary send_row_button2">Attach document</button>
          </div>
    </div>
</template>


<script>
    export default {
        props: ['user','reciver'],

        data() {
            return {
                newMessage: ''
            }
        },

        methods: {
            sendMessage() {
                this.$emit('messagesent', {
                    user: this.user,
                    message: this.newMessage,
                    reciver: this.reciver
                });

                this.newMessage = ''
            }
        }    
    }
</script>
