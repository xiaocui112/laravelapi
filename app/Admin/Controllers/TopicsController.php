<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use App\Models\Reply;
use App\Models\Topic;
use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Frozennode\Administrator\Actions\Action;

class TopicsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '博客管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Topic);

        $grid->column('id', __('Id'));
        $grid->column('title', __('标题'));
        // $grid->column('body', __('Body'));
        $grid->column('user_id', __('用户'))->display(function ($user_id) {
            return User::find($user_id)->name;
        });
        $grid->column('category_id', __('分类'))->display(function ($category) {
            return Category::find($category)->name;
        });
        $grid->column('created_at', __('创建时间'));
        $grid->column('updated_at', __('更改时间'));
        $grid->actions(function ($action) {
            $action->disableView();
            $action->disableEdit();
        });
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Topic::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('body', __('Body'));
        $show->field('user_id', __('User id'));
        $show->field('category_id', __('Category id'));
        $show->field('reply_count', __('Reply count'));
        $show->field('view_count', __('View count'));
        $show->field('last_reply_user_id', __('Last reply user id'));
        $show->field('order', __('Order'));
        $show->field('excerpt', __('Excerpt'));
        $show->field('slug', __('Slug'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Topic);

        $form->text('title', __('Title'));
        $form->textarea('body', __('Body'));
        $form->number('user_id', __('User id'));
        $form->number('category_id', __('Category id'));
        $form->number('reply_count', __('Reply count'));
        $form->number('view_count', __('View count'));
        $form->number('last_reply_user_id', __('Last reply user id'));
        $form->number('order', __('Order'));
        $form->textarea('excerpt', __('Excerpt'));
        $form->text('slug', __('Slug'));

        return $form;
    }
    public function destroy($id)
    {
        Reply::where('topic_id', $id)->delete();
        Topic::find($id)->delete();
    }
}
