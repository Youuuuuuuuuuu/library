<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Books;
use app\models\Author;
use app\models\BookSearch;
use app\models\LoansForm;
use app\models\BookForm;
use app\models\Users;
use app\models\DeleteBook;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionAllBooks()
    {
        $books = Books::find()->with('author')->all();

        $search = new BookSearch();

        return $this->render('allBooks', [
            'books' => $books,
            'search' => $search
        ]);
    }

    public function actionSearchBook()
    {
        $search = new BookSearch();

        if ($search->load(Yii::$app->request->post()) && $search->validate()) {
            $books = Books::find()
                ->joinWith('author')
                ->where(['author.surname' => $search->surname])
                ->all();
        }
        return $this->render('serchBook', [
            'books' => $books,
            'search' => $search
        ]);
    }

    public function actionAddBook()
    {
        $bookForm = new BookForm();

        $authors = Author::find()->all();

        if ($bookForm->load(Yii::$app->request->post())) {
            $findBook = Books::find()
            ->where(['title' => $bookForm->title])
            ->andWhere(['author_id' => $bookForm->author_id])
            ->one();
            if($findBook !== null){
                $findBook->sum += $bookForm->sum;
                $findBook->available += $bookForm->sum;
                if($findBook->save()){
                    Yii::$app->session->setFlash('success', 'Книга успешно добавлена.');
                    return $this->redirect(['index']);
                }else{
                    Yii::$app->session->setFlash('error', 'Книга не добавлена.');
                }
            }else{
                $bookForm->available = $bookForm->sum;
                if($bookForm->save()){
                    Yii::$app->session->setFlash('success', 'Книга успешно добавлена.');
                    return $this->redirect(['index']);
                }else{
                    Yii::$app->session->setFlash('error', 'Книга не добавлена.');
                }
            }
        }

        return $this->render('addBook', [
            'bookForm' => $bookForm,
            'authors' => $authors,
        ]);
    }

    public function actionGetBook()
    {
        $books = Books::find()->where(['>', 'available', 0])->all();
        $users = Users::find()->all();
        $loansForm = new LoansForm();
    
        if ($loansForm->load(Yii::$app->request->post())) {
            if ($loansForm->book_id) {
                $book = Books::findOne(['id' => $loansForm->book_id]);
                if ($book) {
                    $book->sum -= 1;
                    $book->available -= 1;
                    if ($book->save()) {
                        $loansForm->save();
                        Yii::$app->session->setFlash('success', 'Книга выдана посетителю');
                        return $this->redirect(['index']);
                    } else {
                        Yii::$app->session->setFlash('error', 'Не удалось обновить данные книги.');
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Книга не найдена.');
                }
            }
        }

        return $this->render('getBook', [
            'books' => $books,
            'users' => $users,
            'loansForm' => $loansForm
        ]);
    }

    public function actionDeleteBook()
    {
        $books = Books::find()->where(['>', 'available', 0])->all();

        $deleteForm = new DeleteBook();

        if ($deleteForm->load(Yii::$app->request->post())) {
            $book = Books::findOne(['id' => $deleteForm->id]);
            if($book != null){
                if($book->sum == 1 && $book->available == 1){
                    if($book->delete()){
                        Yii::$app->session->setFlash('success', 'Книга списана, экземпляров не осталось');
                        return $this->redirect(['index']);
                    }else {
                        Yii::$app->session->setFlash('error', 'Книга не списана');
                    }
                }else {
                    $book->sum -= 1;
                    $book->available -= 1;
                    if($book->save()){
                        Yii::$app->session->setFlash('success', 'Книга списана');
                        return $this->redirect(['index']);
                    }else{
                        Yii::$app->session->setFlash('error', 'Книга не списана');
                    }
                }
            }
        }

        return $this->render('deleteBook', [
            'books' => $books,
            'deleteForm' => $deleteForm,
        ]);
    }

}
