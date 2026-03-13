@extends('layouts.app')
@section('title','សិស្សតាមថ្នាក់')

@section('content')

<div class="container-fluid px-4 py-4">

    <!-- ================= HEADER ================= -->
    <div class="page-header d-flex flex-wrap align-items-center justify-content-between">
        <div class="page-title">
            <h4>
                <i class="bi bi-mortarboard"></i>
                បញ្ជីសិស្សតាមថ្នាក់នីមួយៗ
            </h4>
            <p style="color: var(---primary)">គ្រប់គ្រង និងតាមដានសិស្សតាមកម្រិតថ្នាក់ផ្សេងៗ</p>
        </div>
        
        <div class="d-flex gap-3 align-items-center">
            <div class="stats-badge" style="color: var(--light)">
                <i class="bi bi-people-fill"></i>
                @php
                    $grades = [
                        'មតេយ្យ',
                        '១ ក', '១ ខ',
                        '២ ក', '២ ខ',
                        '៣ ក', '៣ ខ',
                        '៤ ក', '៤ ខ',
                        '៥ ក', '៥ ខ',
                        '៦ ក', '៦ ខ',
                        '៧ ក', '៧ ខ',
                        '៨ ក', '៨ ខ',
                        '៩ ក', '៩ ខ',
                        '១០ ក', '១០ ខ',
                        '១១ ក', '១១ ខ',
                        '១២ ក', '១២ ខ'
                    ];
                @endphp
                <span class="fw-bold" >{{ $totalStudents }}</span> នាក់
            </div>
            
            <div class="search-container d-none d-md-block">
                <i class="bi bi-search search-icon"></i>
                <input type="text" id="gradeSearch" class="modern-search-light" placeholder="ស្វែងរកថ្នាក់...">
            </div>
        </div>
    </div>

    <!-- ================= SUMMARY STATISTICS ================= -->
    @php
        $preschoolCount = $studentCounts['មតេយ្យ'] ?? 0;
        
        $primaryTotal = 0;
        $secondaryTotal = 0;
        $highTotal = 0;
        
        foreach($grades as $grade) {
            if ($grade != 'មតេយ្យ') {
                if (preg_match('/^[១-៦]/', $grade)) {
                    $primaryTotal += $studentCounts[$grade] ?? 0;
                } elseif (preg_match('/^[៧-៩]/', $grade)) {
                    $secondaryTotal += $studentCounts[$grade] ?? 0;
                } elseif (preg_match('/^[១០-១២]/', $grade)) {
                    $highTotal += $studentCounts[$grade] ?? 0;
                }
            }
        }
        
        $primaryClasses = count(array_filter($grades, function($g) { 
            return preg_match('/^[១-៦]/', $g); 
        }));
        
        $secondaryClasses = count(array_filter($grades, function($g) { 
            return preg_match('/^[៧-៩]/', $g); 
        }));
        
        $highClasses = count(array_filter($grades, function($g) { 
            return preg_match('/^[១០-១២]/', $g); 
        }));
    @endphp

    

    <!-- ================= FILTER BUTTONS ================= -->
    <div class="filter-container d-flex align-items-center mb-4 gap-2">
        <button class="filter-btn active" data-filter="all">
            <i class="bi bi-grid-3x3-gap-fill"></i>
            ទាំងអស់
        </button>
        <button class="filter-btn" data-filter="preschool">
            <i class="bi bi-house-heart"></i>
            មតេយ្យ (1)
        </button>
        <button class="filter-btn" data-filter="primary">
            <i class="bi bi-book"></i>
            បឋមសិក្សា 
        </button>
        <button class="filter-btn" data-filter="secondary">
            <i class="bi bi-journal-bookmark-fill"></i>
            អនុវិទ្យាល័យ 
        </button>
        <button class="filter-btn" data-filter="high">
            <i class="bi bi-mortarboard"></i>
            វិទ្យាល័យ 
        </button>
        
        <div class="ms-auto">
            <div class="dropdown">
                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="bi bi-sort-down"></i> តម្រៀប
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" id="sortAsc"><i class="bi bi-sort-numeric-down-alt me-2"></i> ថ្នាក់ ក-ខ</a></li>
                    <li><a class="dropdown-item" href="#" id="sortDesc"><i class="bi bi-sort-numeric-down me-2"></i> ថ្នាក់ ខ-ក</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- ================= GRADE CARDS ================= -->
    <div class="grade-grid" id="gradeGrid">
        @foreach($grades as $grade)
        @php
            // Determine level and icon based on grade name
            $level = '';
            $icon = '';
            $badgeText = '';
            
            if ($grade == 'មតេយ្យ') {
                $level = 'preschool';
                $icon = 'bi-house-heart';
                $badgeText = 'មតេយ្យ';
            } else {
                // Extract Khmer number from grade
                preg_match('/^[០-៩]+/', $grade, $matches);
                $number = $matches[0] ?? null;

                // Convert Khmer number to Arabic number
                $khmerNumbers = [
                    '០'=>'0','១'=>'1','២'=>'2','៣'=>'3','៤'=>'4',
                    '៥'=>'5','៦'=>'6','៧'=>'7','៨'=>'8','៩'=>'9'
                ];
                $number = strtr($number, $khmerNumbers);
                $number = (int)$number;

                if ($number >= 1 && $number <= 6) {
                    $level = 'primary';
                    $icon = 'bi-book';
                    $badgeText = 'បឋមសិក្សា';
                } elseif ($number >= 7 && $number <= 9) {
                    $level = 'secondary';
                    $icon = 'bi-journal-bookmark-fill';
                    $badgeText = 'អនុវិទ្យាល័យ';
                } elseif ($number >= 10 && $number <= 12) {
                    $level = 'high';
                    $icon = 'bi-mortarboard';
                    $badgeText = 'វិទ្យាល័យ';
                }
            }

            $count = $studentCounts->get($grade, 0);
        @endphp
        <div class="grade-card" 
             data-grade="{{ $grade }}" 
             data-level="{{ $level }}">
            
            {{-- FIXED: Use grade-level-badge instead of level-badge --}}
            <span class="grade-level-badge">
                <i class="bi {{ $icon }}"></i> {{ $badgeText }}
            </span>
            
            <div class="card-body">
                <div class="grade-icon-wrapper">
                    <i class="bi {{ $icon }} grade-icon"></i>
                </div>
                
                <h5 class="grade-title">ថ្នាក់ទី {{ $grade }}</h5>
                
                <div class="student-count">
                    <i class="bi bi-person-badge"></i>
                    <span>{{ $count }} នាក់</span>
                </div>
                
                <a href="{{ route('students.grade', $grade) }}" class="view-btn">
                    <span>ចូលមើលថ្នាក់</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
        @endforeach
    </div>

</div>

<!-- ================= JAVASCRIPT ================= -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Search functionality
        const searchInput = document.getElementById('gradeSearch');
        const gradeCards = document.querySelectorAll('.grade-card');
        
        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                const query = this.value.toLowerCase();
                
                gradeCards.forEach(card => {
                    const gradeName = card.dataset.grade.toLowerCase();
                    if (gradeName.includes(query)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        }
        
        // Filter buttons
        const filterBtns = document.querySelectorAll('.filter-btn');
        
        filterBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remove active class from all buttons
                filterBtns.forEach(b => b.classList.remove('active'));
                
                // Add active class to clicked button
                this.classList.add('active');
                
                const filter = this.dataset.filter;
                
                gradeCards.forEach(card => {
                    if (filter === 'all') {
                        card.style.display = 'block';
                    } else {
                        const level = card.dataset.level;
                        if (level === filter) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    }
                });
            });
        });
        
        // Sort functionality
        document.getElementById('sortAsc').addEventListener('click', function(e) {
            e.preventDefault();
            sortGrades('asc');
        });
        
        document.getElementById('sortDesc').addEventListener('click', function(e) {
            e.preventDefault();
            sortGrades('desc');
        });
        
        function sortGrades(order) {
            const grid = document.getElementById('gradeGrid');
            const cards = Array.from(grid.children);
            
            cards.sort((a, b) => {
                const gradeA = a.dataset.grade;
                const gradeB = b.dataset.grade;
                
                // Special case for preschool
                if (gradeA === 'មតេយ្យ') return order === 'asc' ? -1 : 1;
                if (gradeB === 'មតេយ្យ') return order === 'asc' ? 1 : -1;
                
                // Parse grade number and letter
                const parseGrade = function(grade) {
                    const khmerToNumber = {
                        '១': 1, '២': 2, '៣': 3, '៤': 4, '៥': 5,
                        '៦': 6, '៧': 7, '៨': 8, '៩': 9, '១០': 10,
                        '១១': 11, '១២': 12
                    };
                    
                    const parts = grade.split(' ');
                    const khmerNum = parts[0];
                    const letter = parts[1] || '';
                    
                    return {
                        num: khmerToNumber[khmerNum] || 0,
                        letter: letter
                    };
                };
                
                const g1 = parseGrade(gradeA);
                const g2 = parseGrade(gradeB);
                
                if (g1.num !== g2.num) {
                    return order === 'asc' ? g1.num - g2.num : g2.num - g1.num;
                }
                
                // Sort by letter (ក comes before ខ)
                if (g1.letter && g2.letter) {
                    if (order === 'asc') {
                        return g1.letter === 'ក' ? -1 : 1;
                    } else {
                        return g1.letter === 'ក' ? 1 : -1;
                    }
                }
                
                return 0;
            });
            
            // Reorder cards
            cards.forEach(card => grid.appendChild(card));
        }
        
        // Ensure "ទាំងអស់" is active on page load
        const allFilterBtn = document.querySelector('.filter-btn[data-filter="all"]');
        if (allFilterBtn) {
            allFilterBtn.classList.add('active');
        }
    });
</script>

@endsection