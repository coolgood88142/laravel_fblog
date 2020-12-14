<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="Access-Control-Allow-Origin" content="*" />
    </head>
    <body>
        <div class="container">
            <div v-cloak id="app" class="content">
                <form action="" method="POST">
                    {{ csrf_field() }}
                    <h2 
                        id="title" 
                        class="text-center text-black font-weight-bold" 
                        style="margin-bottom:20px;">
                    文章查詢
                    </h2>
                    <div style="text-align:right">
                        <input type="button" id="btn_insert" class="btn btn-primary" @click="getAddArticles()" value="新增" />
                    </div><br/>
                    <articles-list
                        :articles-data="articles" 
                        :url-delete="urlDelete"
                        @update-articles="updateArticles"
                        @delete-articles-data="deleteArticlesData"
                        @is-show-message="isShowMessage"
                    >
                    </articles-list>
                    <articles-edit 
                        v-if="showEdit" 
                        @close="showEdit = false" 
                        :edit-title="editTitle"
                        :is-add="isAdd"
                        :url-add="urlAdd"
                        :url-update="urlUpdate"
                        :params="params"
                        @update-articles-data="updateArticlesData"
                        @is-show-message="isShowMessage"
                        
                    >
                    </articles-edit>
                </form>
                <input type="hidden" id="data" value="{{ json_encode($data) }}">
            </div>
        </div>
        <script src="{{mix('js/app.js')}}"></script>
        <script src="{{mix('js/articles.js')}}"></script>
        <link rel="stylesheet" type="text/css" href={{mix('css/app.css')}}>
    </body>
</html>