<template>
    <div class="row create-heading">
        <div class="create-heading-content">
            <form method="POST" :action="{ name: 'headings.store' }"
                  class="create-heading-form" enctype="multipart/form-data">
                <div>
                    <input type="text" class="add-heading-input" placeholder="Назва рубрики" name="name">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">
                            Аватар рубрики
                        </label>
                        <input class="form-control" type="file" id="formFile" name="image">
                    </div>
                </div>
                <div class="submit-button">
                    <button type="submit">
                        Создать
                    </button>
                </div>
            </form>

            <div class="to-page">
                <div>
                    <router-link :to="{ name: 'addInfo' }">
                        Назад
                    </router-link>
                    <router-link :to="{ name: 'start.index' }">
                        На головну
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "HeadingsCreatePage"
}
</script>

<style scoped>

</style>
