namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class HashExistingPasswords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hash:existing-passwords';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hash existing plain text passwords with Bcrypt';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            // Suppose we check if the password is not already hashed
            if (!Hash::needsRehash($user->password)) {
                continue;
            }

            // Hash the password and save
            $user->password = Hash::make($user->password);
            $user->save();
            $this->info("Password for user {$user->email} has been hashed.");
        }

        $this->info('All existing plain text passwords have been hashed.');
        return 0;
    }
}
