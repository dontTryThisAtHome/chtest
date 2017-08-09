<template>
  <transition  name="modal" >
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">
          <div class="modal-header">
            <h3>Ошибка</h3>
          </div>
          <div class="modal-body">
              <h4>{{code}}</h4>
              <h4>{{name}}</h4>
              <p>{{message}}</p>
          </div>
          <div class="modal-footer">
              <button class="btn btn-default" @click='close()'>ОК</button>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>
<script>
    export default {
       data: function () {
              return {
                  name: '',
                  code:'',
                  message:'',
              }
          },
        props:['show'],
        methods:{
          close: function(){
            this.$emit('update:show', false)
          },
          updateData: function(data){
            this.message = data.message;
            this.code = data.code;
            this.name = data.name;
          }
        },  
        mounted() {
            console.log('Error mounted.');
            this.$root.$on('error',this.updateData);
        },
    }
</script>
