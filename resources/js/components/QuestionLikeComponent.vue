<template>
    <form method="post" action="">
        <button v-on:click.prevent="like" class="btn" :class="votedByUserLocal? 'btn-success' : 'btn-primary'">{{votesCountLocal}}</button>
    </form>
</template>

<script>
    export default {
        props: [
            'votesCount',
            'votedByUser',
            'questionId'
        ],
        data: function(){
            return {
                likeSending : false,
                votesCountLocal: this.votesCount,
                votedByUserLocal: this.votedByUser
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            like: function() {
                if(!this.likeSending) {
                    this.likeSending = true;

                    axios.post("/votes/" + this.questionId).then((response) => {
                        this.votesCountLocal = response.data;
                        this.likeSending = false;
                        this.votedByUserLocal = !this.votedByUserLocal;
                    },
                    (error) => {
                    if(error.response.status == 401) {
                        alert('Для размещения лайка необходимо авторизоваться!');
                    }
                    });
                }
            },
        }
    }
</script>
