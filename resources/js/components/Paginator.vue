<template>
    <div class="mt-4">
        <ul class="pagination" v-if="shouldPaginate">
            <li class="page-item" v-show="prevUrl">
                <a class="page-link" href="#" aria-label="Previous" @click.prevent="page--">
                    <span aria-hidden="true"> &laquo; Previous </span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <li class="page-item" v-show="nextUrl">
                <a class="page-link" href="#" aria-label="Next" @click.prevent="page++">
                    <span aria-hidden="true">  Next &raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: ['dataSet'],
        data () {
            return {
                page: 1,
                prevUrl: '',
                nextUrl: ''
            }
        },
        watch: {
            dataSet() {
                this.page = this.dataSet.current_page;
                this.prevUrl = this.dataSet.prev_page_url;
                this.nextUrl =this.dataSet.next_page_url;
            },
            page() {
                this.broadcast()
            }
        },
        methods: {
            broadcast(){
                this.$emit('updated', this.page)
            }
        },
        computed: {
            shouldPaginate () {
                return !!(this.prevUrl || this.nextUrl)
            }

        }
    }
</script>

<style scoped>

</style>
