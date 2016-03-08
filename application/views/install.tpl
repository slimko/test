{config_load file='example.conf'}
{include file='header.tpl'}
<div class="col-sm-12 col-md-12 col-lg-12">
    {if isset($error) }
        <div class="alert alert-danger " role="alert"><h4 class="text-center">{$error}</h4></div>
    {/if}
    <h3 class="text-center">Укажите параметры для подключения к Вашей базе данных</h3>
    <form action="http://{$smarty.server.SERVER_NAME}/install" method="post" class="form-horizontal">
        <div class="form-group">
            <label for="server_name" class="col-sm-4  col-md-4 control-label">Server name:</label>
            <div class="col-sm-4  col-md-4">
                <input type="text" class="form-control" maxlength="40" name="server_name" id="server_name" value="" placeholder="Введите адрес сервера">
            </div>
        </div>
        <div class="form-group">
            <label for="user_name" class="col-sm-4  col-md-4 control-label">User name:</label>
            <div class="col-sm-4  col-md-4">
                <input type="text" class="form-control" maxlength="40" name="user_name" id="user_name" value="" placeholder="Введите имя пользователя базы данных">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-4  col-md-4 control-label">Password:</label>
            <div class="col-sm-4  col-md-4">
                <input type="password" class="form-control" maxlength="40" name="password" id="password" value="" placeholder="Введите пароль от базы данных">
            </div>
        </div>
        <div class="form-group">
            <label for="database" class="col-sm-4  col-md-4 control-label">Database:</label>
            <div class="col-sm-4  col-md-4">
                <input type="text" class="form-control" maxlength="40" name="database" id="database" value="" placeholder="Введите название базы данных">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-6">
                <button type="submit" class="btn btn-primary col-sm-3">Установить</button>
                <button type="reset" class="btn btn-default col-sm-3 col-sm-offset-1">Очистить</button>
            </div>
        </div>
        </form>
    </div>
{include file='footer.tpl'}