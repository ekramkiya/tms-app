<?php

namespace App\Filament\Resources\FormEntries;

use App\Filament\Resources\FormEntries\Pages\ManageFormEntries;
use App\Models\FormEntry;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\Filter;
use Morilog\Jalali\Jalalian;
use Carbon\Carbon;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

use Illuminate\Database\Eloquent\Builder;

class FormEntryResource extends Resource
{
    protected static ?string $model = FormEntry::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-folder';
    protected static ?string $recordTitleAttribute = 'yes';
    protected static ?string $navigationLabel = 'فرم‌ها'; // For example, "Forms" in Dari

    protected static ?string $modelLabel = 'فرم';
    protected static ?string $pluralModelLabel = 'فرم‌ها';
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('user_id')
                    ->default(auth()->id())
                    ->required(),

                TextInput::make('checked_unit')
                    ->label('واحد بررسی شده'),

                TextInput::make('years_of_review')
                    ->label('سال‌های بررسی شده'),

                TextInput::make('found')
                    ->label('یافته‌ها'),

                TextInput::make('order')
                    ->label('سفارش'),

                TextInput::make('excellent_goods')
                    ->label('اجناس فاضل'),

                TextInput::make('remaining_items')
                    ->label('اجناس باقی '),

                Textarea::make('guidance_corrective_and_advisory')
                    ->label('راهنمایی (اصلاحی و مشوره)')
                    ->columnSpanFull(),

                TextInput::make('disciplinary')
                    ->label('تأدیبی'),

                TextInput::make('refund_amount')
                    ->label('مبلغ بازگشتی  ')
                    ->numeric(),

                TextInput::make('achieved')
                    ->label('تحصیل شده'),

                TextInput::make('remaining')
                    ->label('باقی‌مانده'),

                TextInput::make('follow_up_letter_number_1')
                    ->label('شماره مکتوب تعقیبی ۱'),

                TextInput::make('follow_up_letter_number_2')
                    ->label('شماره مکتوب تعقیبی ۲'),

                TextInput::make('follow_up_letter_number_3')
                    ->label('شماره مکتوب تعقیبی ۳'),

                TextInput::make('written_confirmation_number_of_compliance')
                    ->label('نمبر مکتوب اطمینانیه از تطبیق'),


                Select::make('done_not_done')
                    ->label('انجام شده / انجام نشده')
                    ->options([
                        'done' => 'انجام شده',
                        'not done' => 'انجام نشده',
                    ])
                    ->nullable(),

                Textarea::make('reason_for_non_compliance')
                    ->label(' علت عذم تطبیق ')
                    ->columnSpanFull(),

                TextInput::make('responsible_department')
                    ->label('بخش مسئول'),

                Textarea::make('considerations')
                    ->label('ملاحظات')
                    ->columnSpanFull(),

                Repeater::make('files')
                    ->relationship()
                    ->label('ضمیمه‌ها')
                    ->schema([
                        FileUpload::make('filepath')
                            ->disk('public')
                            ->directory('form-files')
                            ->visibility('public')
                            ->preserveFilenames()
                            ->openable()
                            ->downloadable(),

                        Hidden::make('filename'),
                    ])
                    ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('checked_unit') // use a real column as record title
            ->columns([
                TextColumn::make('user.name')
                    ->label('کاربر')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('checked_unit')
                    ->label('واحد بررسی شده')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('years_of_review')
                    ->label('سال‌های بررسی شده')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('found')
                    ->label('یافته‌ها')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('order')
                    ->label('سفارش')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('excellent_goods')
                    ->label('اجناس فاضل')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('remaining_items')
                    ->label('اجناس باقی')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('disciplinary')
                    ->label('تأدیبی')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('refund_amount')
                    ->label('مبلغ بازگشتی')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('achieved')
                    ->label('تحصیل شده')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('remaining')
                    ->label('باقی‌مانده')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('follow_up_letter_number_1')
                    ->label('شماره مکتوب تعقیبی ۱')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('follow_up_letter_number_2')
                    ->label('شماره مکتوب تعقیبی ۲')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('follow_up_letter_number_3')
                    ->label('شماره مکتوب تعقیبی ۳')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('written_confirmation_number_of_compliance')
                    ->label('نمبر مکتوب اطمینانیه از تطبیق')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('done_not_done')
                    ->label('انجام شده / انجام نشده')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('reason_for_non_compliance')
                    ->label('علت عدم تطبیق')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('responsible_department')
                    ->label('بخش مسئول')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('considerations')
                    ->label('ملاحظات')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('تاریخ ایجاد')
                    ->jalaliDateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('تاریخ به‌روزرسانی')
                    ->jalaliDateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
->filters([
    Filter::make('created_at')
        ->form([
            DatePicker::make('created_from')
                ->label('از تاریخ')
                ->jalali(),

            DatePicker::make('created_until')
                ->label('تا تاریخ')
                ->jalali(),
        ])
        ->query(function (Builder $query, array $data): Builder {
            if (!empty($data['created_from'])) {
                $fromDate = Carbon::parse($data['created_from'])->startOfDay();
                $query->whereDate('created_at', '>=', $fromDate);
            }

            if (!empty($data['created_until'])) {
                $toDate = Carbon::parse($data['created_until'])->endOfDay();
                $query->whereDate('created_at', '<=', $toDate);
            }

            return $query;
        }),
])
            ->recordActions([
                EditAction::make()->label('ویرایش'),
                DeleteAction::make()->label('حذف'),
                ViewAction::make()->label('نمایش'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    ExportBulkAction::make()->label('خروجی به اکسل'),
                    // DeleteBulkAction::make()->label('حذف گروهی'),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageFormEntries::route('/'),
        ];
    }
}