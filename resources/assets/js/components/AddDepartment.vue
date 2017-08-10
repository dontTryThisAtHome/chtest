<template>
  <transition  name="modal" >
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">
          <div class="modal-header">
            <h3>Добавить отдел</h3>
          </div>
          <div class="modal-body">
              <form id='addDept' v-on:submit.prevent='add()'>
                <div class="form-group">
                  <label for="addDeptName" >Название</label>
                  <input type="text" class="form-control" ref='name' id='addDeptName' placeholder="Название" v-model='name'>
                </div>
              </form>
          </div>
          <div class="modal-footer">
              <p style="color:red;">{{error}}</p>
              <button type='submit' form='addDept' class="btn btn-default" >Добавить</button>
              <button class="btn btn-default" @click='close()'>Отмена</button>
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
              error:'',
            }
          },
    props:['show'],
    watch:{
      show:function(){
        this.$refs.name.focus();
      }
    },
    methods:{
      close: function(){
        this.$emit('update:show', false)
        this.error = '';
      },
      add:function(){
        axios({
          method:'POST',
          url:'api/departments',
          data:{
            name:this.name,
          }
        })
        .then((response)=> {
          this.update();
          this.close();
          this.name='';
          this.error='';
        })
        .catch((error)=>{
          this.showError(error.response.data.message);
        });
      },
      showError:function(error){
        this.error = '*'+error;
      },
      update: function(){
        this.$root.$emit('update');
      }
    },
    mounted() {
      document.addEventListener("keydown", (e) => {
        if (this.show && (e.keyCode == 27 )) {
        this.close();
        }
      });
    },
}
</script>
