<template>
    <form class="form-horizontal">
        <legend>Настройки сервиса</legend>
        <div class="form-group">
           <label class="control-label">Суточный лимит</label>
           <div class="col-xlg">
               <input class="form-control" value="10">
           </div>
        </div>
        <div class="form-group">
           <label class="control-label">Персональный лимит</label>
           <div class="col-xlg">
               <input class="form-control" value="10">
           </div>
        </div>
        <div class="form-group">
           <div class="col-xlg">
              <button type="submit" class="btn btn-primary">Сохранить</button>
           </div>
        </div>
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
