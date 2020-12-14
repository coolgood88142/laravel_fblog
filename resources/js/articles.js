import articlesList from './components/articles/List.vue';
import articlesEdit from './components/articles/Edit.vue';

let data = JSON.parse(document.getElementById('data').value);

let app = new Vue({
    el: '#app',
    components: {
        'articles-list': articlesList,
        'articles-edit': articlesEdit
    },
    data: {
        editTitle: '',
        showEdit: false,
        isAdd: false,
        articles: data.articles,
        urlAdd: data.add,
        urlUpdate: data.update,
        urlDelete: data.delete,
        params: {
            'id': '',
            'title': '',
            'content': '',
            'slug': ''
        },
        articlesDataIndex: null
    },
    methods: {
        getAddArticles() {
            this.editTitle = '新增文章'
            this.showEdit = true
            this.isAdd = true
            this.params = {
                'id': '',
                'title': '',
                'content': '',
                'slug': ''
            }
        },
        updateArticles(id, title, content, slug, index) {
            this.editTitle = '更新文章'
            this.showEdit = true
            this.params = {
                'id': id,
                'title': title,
                'content': content,
                'slug': slug
            }
            this.articlesDataIndex = index
            this.isAdd = false
        },
        updateArticlesData(params) {
            if (this.articlesDataIndex != null) {
                this.articles[this.articlesDataIndex].title = params.title
                this.articles[this.articlesDataIndex].content = params.content
                this.articles[this.articlesDataIndex].slug = params.slug
            }else{
                this.articles.push(params)
                this.articlesDataIndex = null
            }
        },
        deleteArticlesData(index) {
            this.articlesDataIndex = index
            if (this.articlesDataIndex != null) {
                this.articles.splice(this.articlesDataIndex, 1)
            }
        },
        isShowMessage(isSuccess, message){
            let isAdd =  this.isAdd
            swal({
                title: message,
                icon: isSuccess ? 'success':'error',
                buttons:  'OK',
                dangerMode: true,
            }).then(function() {
                if (isSuccess && isAdd){
                    location.reload()
                }
            })

            if (isSuccess) {
                this.showEdit = false
            }
        }
    },
    
})