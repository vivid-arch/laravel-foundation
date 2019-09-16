# Laravel Vivid Architecture

Vivid Architecture is an architectural package that assists in wiring clean code. It is based on Lucid which was released in 2016 by VineLabs.

### Differences with Lucid

+ Vivid ditched the scaffold. You can just pull the `foundation-laravel` and you are ready to go.
+ Vivid files are now inside the `/app` directory instead of the `/src`.
+ Added a call stack inside the IoC. By resolving a specific class you can see debug information regarding which feature has been called, the sequense of jobs and other useful data.
+ Seperated and rewrote the Dashboard in to a third package independed of the console.
+ Models are a concern of Laravel and not Vivid. Therefore you can only generate them using the laravel command.
+ Services have been renamed to Devices.
+ You can no longer delete files using the console.
