<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $card->employee->name }}</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .page {
            width: 210mm;
            height: 297mm;
            margin: auto;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-template-rows: repeat(5, auto);
            gap: 5mm;
            padding: 5mm;
            box-sizing: border-box;
        }

        .business-card {
            width: 85mm;
            height: 55mm;
            display: flex;
            background: #ffffff;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
        }

        .left {
            /*            background: linear-gradient(248deg, rgba(255, 143, 10, 1) 0%, rgba(77, 52, 8, 1) 82%);*/
            color: #393939;
            width: 40%;
            padding: 10px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            line-height: 1.2;
            box-sizing: border-box;
        }

        .left .info {
            font-size: 8px;
            margin: 5px 0;
        }

        .left .info i {
            margin-right: 5px;
        }

        .right {
            flex: 1;
            padding: 10px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            box-sizing: border-box;
        }

        .right .name {
            font-size: 14px;
            font-weight: bold;
        }

        .right .position {
            font-size: 10px;
            color: #555;
            margin-bottom: 10px;
        }

        .right .logo img {
            height: 40px;
            margin-top: 10px;
        }

        @media print {
            body {
                background-color: #fff;
            }

            .page {
                box-shadow: none;
                margin: 0;
                padding: 0;
            }

            .business-card {
                box-shadow: none;
            }
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="no-print">
        <div class="float-end">
            <a href="javascript:window.print()" class="btn-styled">Export in PDF</a>
        </div>
    </div>

<style>
    @media print {
    .no-print {
        display: none !important;
    }
}

</style>

    <div class="page">



        <!-- Repeat the above block 9 more times -->
        <div class="business-card" style="display: flex; position: relative;">
            <div class="left" style="margin-left: 8px; position: relative; flex: 1;">
                <div class="info" style="display: flex; align-items: center; margin-bottom: 8px;">
                    <i class="fas fa-phone" style="margin-right: 8px;"></i> {{ $card->employee->phone }}
                </div>
                <div class="info" style="display: flex; align-items: center; margin-bottom: 8px;">
                    <i class="fas fa-envelope" style="margin-right: 8px;"></i> {{ $card->employee->email }}
                </div>
                <div class="info" style="display: flex; align-items: center; margin-bottom: 8px;">
                    <i class="fas fa-globe" style="margin-right: 8px;"></i> {{ $card->detail->website }}
                </div>

                <div class="info" style="display: flex; align-items: center; margin-bottom: 8px;">
                    <i class="fas fa-home" style="margin-right: 8px;"></i>{{ $card->detail->address }}
                </div>

            </div>

            <div class="vertical-line"
                style="
         border-left: 1px solid #ccc;
         height: calc(100% - 40px);
         margin: 10px 0;">
            </div>
            <div class="right" style="flex: 1; margin-left: 05px;">
                <div class="logo">
                    <img src="/logos/{{ $card->detail->image }}" alt="Logo">
                </div> <br>
                <div class="name">{{ $card->employee->name }}</div>
                <div class="position">{{ $card->employee->designation }}</div>

            </div>
        </div>
        <!-- Repeat the above block 9 more times -->

                <!-- Repeat the above block 9 more times -->
                <div class="business-card" style="display: flex; position: relative;">
                    <div class="left" style="margin-left: 8px; position: relative; flex: 1;">
                        <div class="info" style="display: flex; align-items: center; margin-bottom: 8px;">
                            <i class="fas fa-phone" style="margin-right: 8px;"></i> {{ $card->employee->phone }}
                        </div>
                        <div class="info" style="display: flex; align-items: center; margin-bottom: 8px;">
                            <i class="fas fa-envelope" style="margin-right: 8px;"></i> {{ $card->employee->email }}
                        </div>
                        <div class="info" style="display: flex; align-items: center; margin-bottom: 8px;">
                            <i class="fas fa-globe" style="margin-right: 8px;"></i> {{ $card->detail->website }}
                        </div>

                        <div class="info" style="display: flex; align-items: center; margin-bottom: 8px;">
                            <i class="fas fa-home" style="margin-right: 8px;"></i>{{ $card->detail->address }}
                        </div>

                    </div>

                    <div class="vertical-line"
                        style="
                 border-left: 1px solid #ccc;
                 height: calc(100% - 40px);
                 margin: 10px 0;">
                    </div>
                    <div class="right" style="flex: 1; margin-left: 05px;">
                        <div class="logo">
                            <img src="/logos/{{ $card->detail->image }}" alt="Logo">
                        </div> <br>
                        <div class="name">{{ $card->employee->name }}</div>
                        <div class="position">{{ $card->employee->designation }}</div>

                    </div>
                </div>
                        <!-- Repeat the above block 9 more times -->
        <div class="business-card" style="display: flex; position: relative;">
            <div class="left" style="margin-left: 8px; position: relative; flex: 1;">
                <div class="info" style="display: flex; align-items: center; margin-bottom: 8px;">
                    <i class="fas fa-phone" style="margin-right: 8px;"></i> {{ $card->employee->phone }}
                </div>
                <div class="info" style="display: flex; align-items: center; margin-bottom: 8px;">
                    <i class="fas fa-envelope" style="margin-right: 8px;"></i> {{ $card->employee->email }}
                </div>
                <div class="info" style="display: flex; align-items: center; margin-bottom: 8px;">
                    <i class="fas fa-globe" style="margin-right: 8px;"></i> {{ $card->detail->website }}
                </div>

                <div class="info" style="display: flex; align-items: center; margin-bottom: 8px;">
                    <i class="fas fa-home" style="margin-right: 8px;"></i>{{ $card->detail->address }}
                </div>

            </div>

            <div class="vertical-line"
                style="
         border-left: 1px solid #ccc;
         height: calc(100% - 40px);
         margin: 10px 0;">
            </div>
            <div class="right" style="flex: 1; margin-left: 05px;">
                <div class="logo">
                    <img src="/logos/{{ $card->detail->image }}" alt="Logo">
                </div> <br>
                <div class="name">{{ $card->employee->name }}</div>
                <div class="position">{{ $card->employee->designation }}</div>

            </div>
        </div>
                <!-- Repeat the above block 9 more times -->
                <div class="business-card" style="display: flex; position: relative;">
                    <div class="left" style="margin-left: 8px; position: relative; flex: 1;">
                        <div class="info" style="display: flex; align-items: center; margin-bottom: 8px;">
                            <i class="fas fa-phone" style="margin-right: 8px;"></i> {{ $card->employee->phone }}
                        </div>
                        <div class="info" style="display: flex; align-items: center; margin-bottom: 8px;">
                            <i class="fas fa-envelope" style="margin-right: 8px;"></i> {{ $card->employee->email }}
                        </div>
                        <div class="info" style="display: flex; align-items: center; margin-bottom: 8px;">
                            <i class="fas fa-globe" style="margin-right: 8px;"></i> {{ $card->detail->website }}
                        </div>

                        <div class="info" style="display: flex; align-items: center; margin-bottom: 8px;">
                            <i class="fas fa-home" style="margin-right: 8px;"></i>{{ $card->detail->address }}
                        </div>

                    </div>

                    <div class="vertical-line"
                        style="
                 border-left: 1px solid #ccc;
                 height: calc(100% - 40px);
                 margin: 10px 0;">
                    </div>
                    <div class="right" style="flex: 1; margin-left: 05px;">
                        <div class="logo">
                            <img src="/logos/{{ $card->detail->image }}" alt="Logo">
                        </div> <br>
                        <div class="name">{{ $card->employee->name }}</div>
                        <div class="position">{{ $card->employee->designation }}</div>

                    </div>
                </div>
                        <!-- Repeat the above block 9 more times -->
        <div class="business-card" style="display: flex; position: relative;">
            <div class="left" style="margin-left: 8px; position: relative; flex: 1;">
                <div class="info" style="display: flex; align-items: center; margin-bottom: 8px;">
                    <i class="fas fa-phone" style="margin-right: 8px;"></i> {{ $card->employee->phone }}
                </div>
                <div class="info" style="display: flex; align-items: center; margin-bottom: 8px;">
                    <i class="fas fa-envelope" style="margin-right: 8px;"></i> {{ $card->employee->email }}
                </div>
                <div class="info" style="display: flex; align-items: center; margin-bottom: 8px;">
                    <i class="fas fa-globe" style="margin-right: 8px;"></i> {{ $card->detail->website }}
                </div>

                <div class="info" style="display: flex; align-items: center; margin-bottom: 8px;">
                    <i class="fas fa-home" style="margin-right: 8px;"></i>{{ $card->detail->address }}
                </div>

            </div>

            <div class="vertical-line"
                style="
         border-left: 1px solid #ccc;
         height: calc(100% - 40px);
         margin: 10px 0;">
            </div>
            <div class="right" style="flex: 1; margin-left: 05px;">
                <div class="logo">
                    <img src="/logos/{{ $card->detail->image }}" alt="Logo">
                </div> <br>
                <div class="name">{{ $card->employee->name }}</div>
                <div class="position">{{ $card->employee->designation }}</div>

            </div>
        </div>
                <!-- Repeat the above block 9 more times -->
                <div class="business-card" style="display: flex; position: relative;">
                    <div class="left" style="margin-left: 8px; position: relative; flex: 1;">
                        <div class="info" style="display: flex; align-items: center; margin-bottom: 8px;">
                            <i class="fas fa-phone" style="margin-right: 8px;"></i> {{ $card->employee->phone }}
                        </div>
                        <div class="info" style="display: flex; align-items: center; margin-bottom: 8px;">
                            <i class="fas fa-envelope" style="margin-right: 8px;"></i> {{ $card->employee->email }}
                        </div>
                        <div class="info" style="display: flex; align-items: center; margin-bottom: 8px;">
                            <i class="fas fa-globe" style="margin-right: 8px;"></i> {{ $card->detail->website }}
                        </div>

                        <div class="info" style="display: flex; align-items: center; margin-bottom: 8px;">
                            <i class="fas fa-home" style="margin-right: 8px;"></i>{{ $card->detail->address }}
                        </div>

                    </div>

                    <div class="vertical-line"
                        style="
                 border-left: 1px solid #ccc;
                 height: calc(100% - 40px);
                 margin: 10px 0;">
                    </div>
                    <div class="right" style="flex: 1; margin-left: 05px;">
                        <div class="logo">
                            <img src="/logos/{{ $card->detail->image }}" alt="Logo">
                        </div> <br>
                        <div class="name">{{ $card->employee->name }}</div>
                        <div class="position">{{ $card->employee->designation }}</div>

                    </div>
                </div>
                        <!-- Repeat the above block 9 more times -->
        <div class="business-card" style="display: flex; position: relative;">
            <div class="left" style="margin-left: 8px; position: relative; flex: 1;">
                <div class="info" style="display: flex; align-items: center; margin-bottom: 8px;">
                    <i class="fas fa-phone" style="margin-right: 8px;"></i> {{ $card->employee->phone }}
                </div>
                <div class="info" style="display: flex; align-items: center; margin-bottom: 8px;">
                    <i class="fas fa-envelope" style="margin-right: 8px;"></i> {{ $card->employee->email }}
                </div>
                <div class="info" style="display: flex; align-items: center; margin-bottom: 8px;">
                    <i class="fas fa-globe" style="margin-right: 8px;"></i> {{ $card->detail->website }}
                </div>

                <div class="info" style="display: flex; align-items: center; margin-bottom: 8px;">
                    <i class="fas fa-home" style="margin-right: 8px;"></i>{{ $card->detail->address }}
                </div>

            </div>

            <div class="vertical-line"
                style="
         border-left: 1px solid #ccc;
         height: calc(100% - 40px);
         margin: 10px 0;">
            </div>
            <div class="right" style="flex: 1; margin-left: 05px;">
                <div class="logo">
                    <img src="/logos/{{ $card->detail->image }}" alt="Logo">
                </div> <br>
                <div class="name">{{ $card->employee->name }}</div>
                <div class="position">{{ $card->employee->designation }}</div>

            </div>
        </div>
                <!-- Repeat the above block 9 more times -->
                <div class="business-card" style="display: flex; position: relative;">
                    <div class="left" style="margin-left: 8px; position: relative; flex: 1;">
                        <div class="info" style="display: flex; align-items: center; margin-bottom: 8px;">
                            <i class="fas fa-phone" style="margin-right: 8px;"></i> {{ $card->employee->phone }}
                        </div>
                        <div class="info" style="display: flex; align-items: center; margin-bottom: 8px;">
                            <i class="fas fa-envelope" style="margin-right: 8px;"></i> {{ $card->employee->email }}
                        </div>
                        <div class="info" style="display: flex; align-items: center; margin-bottom: 8px;">
                            <i class="fas fa-globe" style="margin-right: 8px;"></i> {{ $card->detail->website }}
                        </div>

                        <div class="info" style="display: flex; align-items: center; margin-bottom: 8px;">
                            <i class="fas fa-home" style="margin-right: 8px;"></i>{{ $card->detail->address }}
                        </div>

                    </div>

                    <div class="vertical-line"
                        style="
                 border-left: 1px solid #ccc;
                 height: calc(100% - 40px);
                 margin: 10px 0;">
                    </div>
                    <div class="right" style="flex: 1; margin-left: 05px;">
                        <div class="logo">
                            <img src="/logos/{{ $card->detail->image }}" alt="Logo">
                        </div> <br>
                        <div class="name">{{ $card->employee->name }}</div>
                        <div class="position">{{ $card->employee->designation }}</div>

                    </div>
                </div>
                        <!-- Repeat the above block 9 more times -->
        <div class="business-card" style="display: flex; position: relative;">
            <div class="left" style="margin-left: 8px; position: relative; flex: 1;">
                <div class="info" style="display: flex; align-items: center; margin-bottom: 8px;">
                    <i class="fas fa-phone" style="margin-right: 8px;"></i> {{ $card->employee->phone }}
                </div>
                <div class="info" style="display: flex; align-items: center; margin-bottom: 8px;">
                    <i class="fas fa-envelope" style="margin-right: 8px;"></i> {{ $card->employee->email }}
                </div>
                <div class="info" style="display: flex; align-items: center; margin-bottom: 8px;">
                    <i class="fas fa-globe" style="margin-right: 8px;"></i> {{ $card->detail->website }}
                </div>

                <div class="info" style="display: flex; align-items: center; margin-bottom: 8px;">
                    <i class="fas fa-home" style="margin-right: 8px;"></i>{{ $card->detail->address }}
                </div>

            </div>

            <div class="vertical-line"
                style="
         border-left: 1px solid #ccc;
         height: calc(100% - 40px);
         margin: 10px 0;">
            </div>
            <div class="right" style="flex: 1; margin-left: 05px;">
                <div class="logo">
                    <img src="/logos/{{ $card->detail->image }}" alt="Logo">
                </div> <br>
                <div class="name">{{ $card->employee->name }}</div>
                <div class="position">{{ $card->employee->designation }}</div>

            </div>
        </div>
                <!-- Repeat the above block 9 more times -->
                <div class="business-card" style="display: flex; position: relative;">
                    <div class="left" style="margin-left: 8px; position: relative; flex: 1;">
                        <div class="info" style="display: flex; align-items: center; margin-bottom: 8px;">
                            <i class="fas fa-phone" style="margin-right: 8px;"></i> {{ $card->employee->phone }}
                        </div>
                        <div class="info" style="display: flex; align-items: center; margin-bottom: 8px;">
                            <i class="fas fa-envelope" style="margin-right: 8px;"></i> {{ $card->employee->email }}
                        </div>
                        <div class="info" style="display: flex; align-items: center; margin-bottom: 8px;">
                            <i class="fas fa-globe" style="margin-right: 8px;"></i> {{ $card->detail->website }}
                        </div>

                        <div class="info" style="display: flex; align-items: center; margin-bottom: 8px;">
                            <i class="fas fa-home" style="margin-right: 8px;"></i>{{ $card->detail->address }}
                        </div>

                    </div>

                    <div class="vertical-line"
                        style="
                 border-left: 1px solid #ccc;
                 height: calc(100% - 40px);
                 margin: 10px 0;">
                    </div>
                    <div class="right" style="flex: 1; margin-left: 05px;">
                        <div class="logo">
                            <img src="{{ public_path('logos/' . $card->detail->image) }}" alt="Logo">
                        </div> <br>
                        <div class="name">{{ $card->employee->name }}</div>
                        <div class="position">{{ $card->employee->designation }}</div>

                    </div>
                </div>

        <!-- Repeat the above block 9 more times -->
    </div>
</body>

</html>
