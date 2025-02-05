<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Librarian;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Borrow>
 */
class BorrowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $statusOptions = ['PENDING', 'ACCEPTED', 'REJECTED', 'RETURNED'];
        $status = fake()->randomElement($statusOptions);
        $book_id = fake()->unique()->numberBetween(1, 100);
        $requestProcessedAt = ($status === 'PENDING') ? null : fake()->dateTimeBetween('-1 month', 'now');

        return [
            'reader_id' => random_int(1, 2),
            'book_id' => $book_id,
            'status' => $status,
            'request_processed_at' => ($status == "PENDING") ? null : $requestProcessedAt,
            'request_managed_by' => ($status == "PENDING") ? null : 1,
            'deadline' => ($status == 'PENDING' || $status == 'REJECTED') ? null : fake()->dateTimeBetween($requestProcessedAt, ' +2 weeks'),
            'returned_at' => ($status == 'RETURNED') ? fake()->dateTimeBetween($requestProcessedAt, 'now') : null,
            'return_managed_by' => ($status == 'RETURNED') ? 1 : null,
        ];
    }
}
