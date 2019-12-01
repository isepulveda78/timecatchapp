<template>
   <nav>
       <ul class="pagination justify-content-end mb-0">
           <li class="page-item" :class="{ 'disabled': meta.current_page === 1 }"><a href="#" class="page-link" @click.prevent="switched(meta.current_page - 1)">&laquo;</a></li>
           <template v-if="section > 1">
               <li class="page-item">
                   <a href="#" class="page-link" @click.prevent="switched(1)">1</a>
               </li>
           </template>
          <li class="page-item" v-for="page in pages" :class="{'active': meta.current_page === page }">
               <a href="#" class="page-link" @click.prevent="switched(page)">{{ page }}</a>
            </li>
            <template v-if="section > 1">
               <li class="page-item">
                   <a href="#" class="page-link" @click.prevent="switched(meta.last_page)">{{ meta.last_page }}</a>
               </li>
           </template>
            <li class="page-item" :class="{ 'disabled': meta.current_page === meta.last_page }"><a href="#" class="page-link" @click.prevent="switched(meta.current_page + 1)">&raquo;</a></li>
       </ul>
   </nav>
</template>

<script>
export default {
    props: ['meta'],
    data(){
        return {
            numbersPerSection: 5
        }
    },
    computed: {
        section(){
            return Math.ceil(this.meta.current_page / this.numbersPerSection)
        },
        sections(){
            return Math.ceil(this.meta.last_page / this.numbersPerSection)
        },
        lastPage(){
            let lastPage = ((this.section - 1) * this.numbersPerSection) + this.numbersPerSection

            if(this.section === this.sections){
                lastPage = this.meta.last_page
            }

            return lastPage
        },
        pages(){
            return _.range((this.section - 1) * this.numbersPerSection + 1, 
            this.lastPage + 1
            );
        }
    },
    methods: {
        switched(page)
        {
            if( page <= 0 || page > this.meta.last_page)
            {
                return;
            }
            this.$emit('pagination:switched', page)
        }
    }
}
</script>