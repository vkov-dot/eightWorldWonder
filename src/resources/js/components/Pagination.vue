<template>
    <div class="m-4 pagination-div">
        <ul class="pagination">
            <li v-for="page in totalPages" :key="page">
                <button
                    class="pagination-button btn"
                    :class="{'btn-primary': currentPage === page }"
                    @click="changePage(page)"
                >
                    {{ page }}
                </button>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: "Pagination",
    props: ['total', 'item'],
    data() {
        return {
            currentPage: 1
        }
    },
    computed: {
        totalPages() {
            return Math.ceil(this.total / this.item)
        }
    },
    methods: {
        changePage(pageNumber) {
            this.currentPage = pageNumber
            this.$emit('page-changed', pageNumber)
        }
    }
}
</script>

<style scoped>

</style>
