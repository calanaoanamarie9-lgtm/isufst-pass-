@include('student.documents._form', [
    'action' => route('student.documents.store'),
    'method' => 'POST',
    'submit' => 'Submit Request',
    'documentRequest' => null,
    'documents' => $documents,
    'purposeTypes' => $purposeTypes,
    'educationalStatuses' => $educationalStatuses,
    'educationalLevels' => $educationalLevels,
    'claimModes' => $claimModes,
    'profile' => $profile,
])